# American Dictator website: AI image prompt pack

Companion to the game repo's `IMAGE-PROMPTS.md`. Same look, same rules. These images are
for the marketing site only: the hero, the President's message, and the Patriot Store.

## The look to match (same as the game)
- **Palette:** near-black navy `#070b14`, gold leaf `#c9a227` / soft gold `#e6cf7a`,
  bone / newsprint white `#eef2f8`, hard scarlet `#c0392b` / oxblood `#7a1620` for danger.
  The site also uses a parchment `#efe6d0` in the store section; product shots should sit
  well on both navy and parchment.
- **Texture words for every prompt:** *dark marble, gold leaf, aged newsprint, engraved
  banknote line-work, letterpress, ceremonial, dramatic single-source lighting, matte,
  no gloss.*

## The two rules, unchanged
1. **No real or recognizable living person, no real insignia.** Fictional eagle-and-laurel
   crest, plain deep-blue standards with gold fringe, invented emblems only. Presidential
   at a glance, protected mark never.
2. **Textless.** The site's own fonts (Anton, Spectral, IBM Plex Mono) go on top. Where a
   word is unavoidable it is flagged in the prompt as one short invented word.

Negative prompt to append to every generation:
> `no real people, no celebrity or politician likeness, no real national flag, no real
> presidential seal, no party logo, no watermark, no lens flare, no glossy 3D render, no
> readable body text, no gibberish lettering`

---

## 1. Website hero, "the acclamation" (highest priority)

Replaces or alternates with the inauguration backdrop at the top of the page. The site
overlays the seal, the title, and buttons dead centre, so the composition must keep its
detail at the edges and stay quiet and dark in the middle third.

> A vast night-time victory rally seen from twenty feet behind and slightly above an empty
> presidential lectern, the lectern of dark carved wood bearing a blank gold eagle-and-laurel
> crest, facing an ocean of an unseeable crowd rendered only as thousands of tiny gold
> lights and waving deep-blue banners with gold fringe stretching to the horizon, monumental
> white neoclassical columns framing the left and right edges of the shot, two colossal
> vertical banners hanging from the columns with a blank gold crest where a face would go,
> gold confetti hanging frozen in the beams of four sweeping white searchlights that cross
> in the sky, a faint domed capitol silhouette on the far horizon, low rolling stage smoke
> catching scarlet up-light at the very bottom edge, the centre of the frame kept dark
> navy and almost empty for overlaid type, heroic propaganda-poster composition turned
> faintly sinister, dramatic single-source key light from the lower left, dark marble,
> gold leaf, aged newsprint grain, engraved banknote line-work vignette in the four
> corners, matte, no gloss, cinematic, no people rendered close enough to have faces,
> textless, landscape 21:9, minimum 2560 wide.

**Site use:** `.hero-bg`. Export dark. The middle 60% sits behind gold display type, so if
the generator brightens the centre, burn it down before use.

---

## 2. The President's official portrait, "the back of the head"

For the framed portrait slot in "A Message from the President". Currently that frame holds
the Oval Office art; this replaces it with the joke made visual: an official state portrait
that refuses to show the man.

> A formal official state portrait in the style of a nineteenth-century oil painting, but
> the subject is seen entirely from behind: a broad-shouldered figure in a boxy dark navy
> suit standing at a three-quarter turn away from the viewer, hands clasped behind the back,
> one hand wearing a single oversized gold signet ring with a tiny eagle, the head cropped
> just above the collar by the top of the canvas so no hair or face is ever visible, facing
> tall arched windows with heavy navy drapes and gold tassels, a sliver of a domed capitol
> visible through the glass, a marble bust of an eagle on a plinth to one side, painted in
> thick confident oil brushwork with craquelure varnish texture, lit like a Rembrandt with
> one warm candle-gold key light from the upper left and deep navy shadow everywhere else,
> ceremonial, pompous, faintly absurd, dark marble, gold leaf, matte, aged varnish, an
> ornate carved gold baroque frame painted as part of the image around all four edges,
> textless, portrait 4:5, minimum 1600 wide.

**Site use:** swap into `.portrait-frame` in `index.html`. The caption underneath already
does the joke's second half. Keep the CSS gold border or remove it if the painted frame
reads well; do not stack both if they fight.

---

## 3. Patriot Store product shots

All three sit on parchment `#efe6d0` cards. Shoot them like luxury catalogue photography
that is trying much too hard. Square 1:1, minimum 1200px, subject centred with 15% clear
margin all round so the card padding breathes. If the generator supports transparent
backgrounds, take it; otherwise ask for the seamless dark backdrop below and the site will
mask a soft vignette.

### 3a. $PREZ Coin

> A single ornate gold commemorative coin photographed at a fifteen-degree tilt on black
> velvet, macro product photography, the coin face embossed in deep relief with a stern
> stylised heraldic eagle head in profile wearing a tiny laurel crown, encircled by a ring
> of thirteen five-pointed stars and an outer ring of engraved banknote guilloche
> line-work, the coin edge reeded and catching one hard gold rim-light from the upper
> right, a second dim cool fill from the left so the relief shadows read, one out-of-focus
> duplicate coin standing on edge in the far background bokeh, shallow depth of field,
> matte antique gold finish with worn high points, no mirror shine, dark navy-black
> seamless backdrop, luxurious and absurdly self-important, letterpress grain, textless,
> square 1:1, minimum 1200px. If lettering is demanded by the composition, the single
> invented word PREZ in engraved capitals across the top arc and nothing else.

### 3b. Eagle One, the cologne

> A luxury cologne bottle product photograph on a slab of dark green-black marble, the
> bottle a heavy rectangular flacon of deep translucent navy glass with bevelled shoulders,
> a chunky brushed-gold cap shaped like a stepped art-deco plinth, a thin gold-foil border
> framing a blank matte navy label with an embossed gold eagle-head emblem and no words,
> amber liquid glowing where a single warm spotlight passes through the glass and throws a
> long gold caustic across the marble, one white feather resting beside the base, faint
> smoke curl in the dark background, moody editorial perfume-advert lighting, deep navy
> background falling to black, engraved banknote line-work vignette in the corners, matte,
> ceremonial, ridiculous, textless, square 1:1, minimum 1200px.

### 3c. The Commemorative Pardon, framed

> An ornate hand-carved gold baroque picture frame photographed straight on, hanging on a
> wall of deep navy damask wallpaper with a faint gold fleur pattern, inside the frame an
> aged cream parchment document with ornate flourished calligraphic line-work suggested but
> unreadable, a wide decorative engraved border, a large scarlet wax seal at the bottom
> left trailing two gold ribbons, one blank signature line at the bottom right with a
> theatrical looping signature scrawl that resolves into no actual letters, a small brass
> museum plaque on the frame's lower rail left blank, lit by a single brass picture light
> mounted above the frame throwing a warm pool of gold down the parchment, dust motes in
> the beam, self-satisfied and faintly criminal, letterpress texture, matte, no gloss,
> textless, square 1:1, minimum 1200px.

**Site use:** each image replaces one CSS-drawn `.product-art` block in `index.html`
(`.coin`, `.cologne`, `.pardon`). Keep the CSS versions in the stylesheet as fallbacks.

---

## 4. Optional extras (nice to have, not blocking)

### 4a. The Tribute divider, gold laurel and eagle wings
> A symmetrical ornamental divider of two outstretched engraved gold eagle wings meeting at
> a small laurel wreath centre, rendered as matte engraved gold leaf in the style of
> banknote line-work, on a transparent background, game-icon crispness, uniform lighting,
> no text, wide 4:1, transparent PNG.

**Site use:** section separators between the dark bands, replacing plain borders.

### 4b. The Seeing and Approving Office stamp
> A round rubber-stamp emblem in scarlet ink, slightly smudged and double-struck as if
> stamped in a hurry, a stern simplified eagle head at the centre ringed by a border of
> stars and laurel, distressed ink texture with gaps where the stamp missed, on a
> transparent background, flat graphic, no gradient, no text, square 1:1, transparent PNG.

**Site use:** replaces the CSS-drawn `.seal-stamp` border box next to the President's
letter, and can be scattered at low opacity as a background motif in the FAQ.

### 4c. Store shelf hero, "the merchandise table"
> A long dark-wood table draped in deep-blue bunting with gold fringe at an indoor rally,
> laid out like a merchandise stall with neat pyramids of identical gold coins, ranks of
> navy cologne boxes with blank gold labels, and stacks of gold-framed parchment documents,
> a hand-lettered price card left blank, warm tungsten string lights above, shallow depth
> of field, the honest shabbiness of a fairground stall selling the presidency, matte,
> newsprint grain, no people, textless, landscape 16:9, minimum 1920 wide.

**Site use:** a full-width banner behind or above the Patriot Store heading, cropped to a
short band, with the parchment section starting right below it.

---

## Practical notes
- **Order:** 1 (hero), then 3a-3c together so the store shots share one lighting logic,
  then 2, then the extras.
- Generate at 2x the stated minimums where cheap; the site serves them scaled down.
- Eyeball every output for accidental real-world likeness, a real seal or flag, readable
  gibberish, or glossy-render sheen before it goes in the repo.
- Keep file sizes sane before committing: hero under ~450KB as JPG quality 80, products
  under ~250KB each, transparent PNGs trimmed tight.
- When any of these land, drop them in `adwebsite/assets/` and tell Claude which slot each
  one fills; wiring them in is a five-minute edit.
