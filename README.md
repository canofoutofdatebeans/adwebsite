# American Dictator, the website

The official propaganda site for American Dictator, the satirical political
survival game. Everything on it is fictional, including the store, especially
the store.

Static site, no build step: `index.html`, `css/site.css`, `js/site.js`, `assets/`.

## Hosting & deploy

Hosted on **Krystal** (cPanel) and served at **americandictator.info**. GitHub
is used only for version control; deploys go up over FTP.

Deploy with:

```bash
python deploy.py            # upload the site to Krystal over FTPS
python deploy.py --dry-run  # connect and list, upload nothing
```

Credentials live in `.ftp-credentials` (git-ignored, never committed). Copy the
template, fill in the Krystal FTP host / user / password / web-root, and save:

```
FTP_HOST=ftp.americandictator.info
FTP_USER=...
FTP_PASS=...
FTP_PORT=21
FTP_REMOTE_DIR=/public_html      # or /public_html/americandictator.info for an addon domain
FTP_SECURE=auto                  # prefers encrypted FTPS, falls back to plain FTP
```

## Coming-soon note

The game is going paid (desktop via Steam), so every download card in
`index.html` is a placeholder `<button data-toast>` with a satirical toast.
When a real store page exists, swap the matching button for an `<a href>` to the
listing, and point the hero's gold button at the Steam wishlist.
