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

Things to update when the game ships to stores: the iOS and Android cards in the
Download section of `index.html` are placeholder buttons with satirical "in review"
toasts. Swap each `<button data-toast=...>` for an `<a href>` to the real store listing.
