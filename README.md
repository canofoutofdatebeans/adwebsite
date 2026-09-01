# American Dictator, the website

The official propaganda site for [American Dictator](https://github.com/canofoutofdatebeans/americandictator),
the satirical political survival game. Everything on it is fictional, including the store,
especially the store.

Static site, no build step: `index.html`, `css/site.css`, `js/site.js`, and `assets/`.
Serve it with any static server, for example:

```bash
python -m http.server 8462
```

Deployed via GitHub Pages from the repo root. Art assets are exported from the game project.

The game is going paid (desktop via Steam), so the whole site runs a "coming soon"
treatment: every download card in `index.html` is a placeholder `<button data-toast=...>`
with a satirical toast. When a real store page exists (Steam, App Store, Google Play),
swap the matching button for an `<a href>` to the listing. The hero's gold button
currently anchors to #download; point it at Steam when the wishlist page is up.
