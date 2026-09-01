#!/usr/bin/env python3
"""Deploy the American Dictator site to Krystal over FTP (FTPS preferred).

Reads credentials from .ftp-credentials (git-ignored). Uploads only the site
files (index.html + css/ js/ assets/), never the repo plumbing or secrets.

Usage:
    python deploy.py            # upload changed/new files
    python deploy.py --all      # re-upload everything
    python deploy.py --dry-run  # show what would upload, connect only
"""
import ftplib
import os
import ssl
import sys

ROOT = os.path.dirname(os.path.abspath(__file__))
CRED = os.path.join(ROOT, ".ftp-credentials")

# What actually makes up the website. Everything else stays local.
INCLUDE_FILES = ["index.html", ".nojekyll"]
INCLUDE_DIRS = ["css", "js", "assets"]


def load_creds():
    if not os.path.exists(CRED):
        sys.exit("No .ftp-credentials file. Create it first (see README).")
    c = {}
    with open(CRED, encoding="utf-8") as fh:
        for line in fh:
            line = line.strip()
            if not line or line.startswith("#") or "=" not in line:
                continue
            k, v = line.split("=", 1)
            c[k.strip()] = v.strip()
    for req in ("FTP_HOST", "FTP_USER", "FTP_PASS"):
        if not c.get(req) or c[req].startswith("your-"):
            sys.exit(f"{req} is missing or still a placeholder in .ftp-credentials.")
    c.setdefault("FTP_PORT", "21")
    c.setdefault("FTP_REMOTE_DIR", "/public_html")
    c.setdefault("FTP_SECURE", "auto")
    return c


def gather_local():
    """Return list of (local_path, remote_relative_path)."""
    items = []
    for f in INCLUDE_FILES:
        p = os.path.join(ROOT, f)
        if os.path.isfile(p):
            items.append((p, f.replace("\\", "/")))
    for d in INCLUDE_DIRS:
        base = os.path.join(ROOT, d)
        for dirpath, _, files in os.walk(base):
            for name in files:
                lp = os.path.join(dirpath, name)
                rel = os.path.relpath(lp, ROOT).replace("\\", "/")
                items.append((lp, rel))
    return items


def connect(c):
    host, port = c["FTP_HOST"], int(c["FTP_PORT"])
    secure = c["FTP_SECURE"].lower()
    if secure in ("auto", "yes", "true", "ftps"):
        try:
            ctx = ssl.create_default_context()
            ctx.check_hostname = False
            ctx.verify_mode = ssl.CERT_NONE
            ftps = ftplib.FTP_TLS(context=ctx)
            ftps.connect(host, port, timeout=30)
            ftps.login(c["FTP_USER"], c["FTP_PASS"])
            ftps.prot_p()
            print(f"Connected over FTPS (encrypted) to {host}:{port}")
            return ftps
        except Exception as e:  # noqa: BLE001
            if secure not in ("auto",):
                raise
            print(f"FTPS unavailable ({e.__class__.__name__}), falling back to plain FTP.")
    ftp = ftplib.FTP()
    ftp.connect(host, port, timeout=30)
    ftp.login(c["FTP_USER"], c["FTP_PASS"])
    print(f"Connected over plain FTP to {host}:{port}")
    return ftp


def ensure_dir(ftp, remote_dir):
    """cd into remote_dir, creating each segment as needed."""
    if remote_dir.startswith("/"):
        ftp.cwd("/")
        remote_dir = remote_dir[1:]
    for seg in [s for s in remote_dir.split("/") if s]:
        try:
            ftp.cwd(seg)
        except ftplib.error_perm:
            ftp.mkd(seg)
            ftp.cwd(seg)


def main():
    dry = "--dry-run" in sys.argv
    force_all = "--all" in sys.argv
    c = load_creds()
    items = gather_local()
    total_kb = sum(os.path.getsize(lp) for lp, _ in items) / 1024
    print(f"{len(items)} files to deploy ({total_kb:.0f} KB) -> {c['FTP_HOST']}:{c['FTP_REMOTE_DIR']}")
    if dry:
        for _, rel in sorted(items):
            print("  would upload", rel)

    ftp = connect(c)
    base = c["FTP_REMOTE_DIR"].rstrip("/") or "/"
    ensure_dir(ftp, base)
    print("Remote web root contents:", ", ".join(ftp.nlst()[:12]) or "(empty)")
    if dry:
        ftp.quit()
        print("Dry run complete. No files were uploaded.")
        return

    made = set()
    current = None
    for lp, rel in sorted(items):
        parts = rel.split("/")
        subdir = "/".join(parts[:-1])
        filename = parts[-1]
        target = base + ("/" + subdir if subdir else "")
        if subdir and subdir not in made:
            ensure_dir(ftp, target)  # creates dirs and leaves us in target
            made.add(subdir)
            current = target
        elif current != target:
            ftp.cwd(target)
            current = target
        with open(lp, "rb") as fh:
            ftp.storbinary("STOR " + filename, fh)
        print("  uploaded", rel)
    ftp.quit()
    print(f"\nDone. {len(items)} files live. Visit http://{c['FTP_HOST'].replace('ftp.', '')}/")


if __name__ == "__main__":
    main()
