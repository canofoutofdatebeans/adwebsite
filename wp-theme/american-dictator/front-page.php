<?php
/**
 * Front page: the propaganda one-pager.
 *
 * @package American_Dictator
 */
get_header();

$ad_letter_default = '<p>My fellow Americans. When I took this office, our country had problems. Big problems. Courts that said no. Newspapers that printed things. A Congress.</p>'
	. '<p>I made you a promise: I would fix all of it, or I would fix the people who noticed. In this game, that promise is yours to keep. You will inherit five institutions in working order, and you will have forty-eight months to do something about that.</p>'
	. '<p>They call it a democracy simulator. It is not. Democracy is what happens when you lose.</p>'
	. '<p class="letter-sign">The President<br><small>(name withheld for legal reasons that are also withheld)</small></p>';

$ad_ticker = ad_lines( 'ad_ticker_lines', array(
	'APPROVAL RATING REACHES 143 PERCENT, POLLSTER PROMOTED TO SAFETY',
	'COURTS AGREE WITH PRESIDENT IN RECORD TIME, JUDGES THANKED AND REPLACED',
	'HURRICANE CORRECTED BY EXECUTIVE ORDER, NOW HEADED WHERE IT WAS TOLD',
	'$PREZ COIN UP 40,000 PERCENT AMONG THOSE REQUIRED TO SAY SO',
	'PRESS SECRETARY TAKES QUESTIONS, KEEPS THEM',
	'ECONOMY DESCRIBED AS TREMENDOUS BY MAN WHO NOW OWNS IT',
	'FREEDOM OCEAN RENAMED AGAIN, OLD MAPS BURNED IN CELEBRATION',
	'ELECTION CONFIRMED FOR WHENEVER',
	'THIS HEADLINE APPROVED BEFORE IT WAS WRITTEN',
) );
?>

<main id="top">
<section class="hero">
	<div class="hero-bg" aria-hidden="true" style="background-image:url('<?php echo ad_img( 'ad_hero_image', 'hero-rally.jpg' ); ?>');"></div>
	<div class="hero-vignette" aria-hidden="true"></div>
	<div class="hero-inner">
		<img class="hero-seal" src="<?php echo ad_img( 'ad_seal', 'seal-512.png' ); ?>" alt="" width="132" height="132" aria-hidden="true">
		<p class="hero-kicker reveal"><?php echo esc_html( ad_mod( 'ad_hero_kicker', 'The Patriot Party presents' ) ); ?></p>
		<h1 class="hero-title" aria-label="<?php echo esc_attr( ad_mod( 'ad_hero_title1', 'AMERICAN' ) . ' ' . ad_mod( 'ad_hero_title2', 'DICTATOR' ) ); ?>">
			<span class="ht-line"><span><?php echo esc_html( ad_mod( 'ad_hero_title1', 'AMERICAN' ) ); ?></span></span>
			<span class="ht-line ht-line2"><span><?php echo esc_html( ad_mod( 'ad_hero_title2', 'DICTATOR' ) ); ?></span></span>
		</h1>
		<p class="hero-tag reveal"><?php echo wp_kses_post( ad_mod( 'ad_hero_tagline', 'One term. One chance. <b>Zero term limits.</b>' ) ); ?></p>
		<p class="hero-sub reveal"><?php echo esc_html( ad_mod( 'ad_hero_sub', 'A satirical political survival game. A crisis lands on your desk every month. You get three bad options, one worse one, and a timer. Capture the courts, the Congress, and the press before the republic notices, or lose the only election you ever intend to hold.' ) ); ?></p>
		<div class="hero-ctas reveal">
			<a class="btn btn-gold btn-big" href="<?php echo esc_url( ad_mod( 'ad_cta_url', '#download' ) ); ?>"><?php echo esc_html( ad_mod( 'ad_cta_label', 'Coming soon. Prepare accordingly.' ) ); ?></a>
			<a class="btn btn-line btn-big" href="#machinery">Inspect the machinery</a>
		</div>
		<div class="hero-stats reveal">
			<div class="stat"><b class="stat-num" id="statApproval">0%</b><span>Approval rating<sup>*</sup></span></div>
			<div class="stat"><b class="stat-num" id="statCrises">0</b><span>Hand-written crises</span></div>
			<div class="stat"><b class="stat-num" id="statTerms">1</b><span>Term (so far)</span></div>
		</div>
		<p class="hero-fine reveal"><sup>*</sup>Figure audited by the President's pollster, who is doing great and has not been threatened.</p>
	</div>
	<div class="hero-podium-note" aria-hidden="true"><span>The podium is empty. It is waiting for you.</span></div>
</section>

<!-- News ticker -->
<div class="ticker" aria-label="Headlines from The National Scream">
	<div class="ticker-label">THE NATIONAL SCREAM</div>
	<div class="ticker-track">
		<div class="ticker-inner" id="tickerInner">
			<?php foreach ( $ad_ticker as $line ) : ?>
				<span><?php echo esc_html( $line ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<!-- Message from the President -->
<section class="section mandate" id="mandate">
	<div class="wrap two-col">
		<figure class="portrait reveal">
			<div class="portrait-frame">
				<img id="presidentPortrait" src="<?php echo ad_img( 'ad_portrait_male', 'portrait-male.jpg' ); ?>" data-alt="<?php echo ad_img( 'ad_portrait_female', 'portrait-female.jpg' ); ?>" alt="The official state portrait: the President, seen from behind, facing a tall window" loading="lazy">
			</div>
			<figcaption><?php echo esc_html( ad_mod( 'ad_portrait_caption', "The official state portrait, painted from the President's best angle." ) ); ?></figcaption>
		</figure>
		<div class="mandate-copy">
			<p class="kicker reveal">A message from the President</p>
			<h2 class="reveal"><?php echo wp_kses_post( ad_mod( 'ad_letter_heading', "\"It's good to be<br>the President.\"" ) ); ?></h2>
			<div class="letter reveal">
				<?php echo wp_kses_post( ad_mod( 'ad_letter_body', $ad_letter_default ) ); ?>
			</div>
			<div class="seal-stamp reveal" aria-hidden="true"><img src="<?php echo ad_img( 'ad_seal', 'seal-192.png' ); ?>" alt=""><span>SEEN AND APPROVED<br>BY THE SEEING AND<br>APPROVING OFFICE</span></div>
		</div>
	</div>
</section>

<!-- Gold plaque divider -->
<section class="plaque-band" aria-hidden="true">
	<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/plaque.jpg' ); ?>" alt="" loading="lazy">
	<div class="plaque-caption"><span>THE GREAT SEAL OF DOING TREMENDOUSLY WELL</span></div>
</section>

<!-- The Machinery -->
<section class="section machinery" id="machinery">
	<div class="wrap">
		<p class="kicker center reveal">Every lever of government, within reach</p>
		<h2 class="center reveal">The Machinery of State</h2>
		<p class="section-sub center reveal">Nine rooms. Each one runs a branch of the country. Each one can be persuaded, purchased, or permanently improved.</p>
		<div class="feature-grid">
			<?php
			$ad_rooms = array(
				array( 'room-press.jpg', 'The Press Room', 'Twelve outlets stand between you and the truth, which is whatever you said this morning. Sue them, buy them, or turn them into fans. Freedom of the press includes your freedom to own one.' ),
				array( 'room-courts.jpg', 'The Bench', 'Ten judges and a lot of opinions. They can be pressured, replaced, or simply outnumbered. If the court keeps ruling against you, the problem is obviously the size of the court.' ),
				array( 'room-war.jpg', 'The War Room', 'Declare war on anyone, for any reason. Glacia looked at you funny. The Hermit Republic exists. The map on the table is mostly red pins now, and the general has started sighing audibly.' ),
				array( 'room-street.jpg', 'Public Order', 'Ten cities, each with its own opinion of you, each wrong. Send in the agencies until morale improves. Unrest is just approval that hasn\'t been processed yet.' ),
				array( 'room-economy.jpg', 'The Treasury', 'Print money. Rename money. Put your face on money. The economy is the strongest it has ever been, according to the man it now legally belongs to.' ),
				array( 'room-pardon.jpg', 'The Pardon Window', 'Forgiveness, wholesale. Pardon allies, strangers, a horse, and eventually, in a private ceremony with excellent catering, yourself.' ),
				array( 'room-call.jpg', 'The Phone', 'An address book of world leaders and five things you can say to each of them, none of them wise. Every call is perfect. Ask anyone who is still allowed to describe it.' ),
				array( 'room-residence.jpg', 'The Residence', 'Thirteen improvements to the People\'s House, starting with more gold and proceeding directly to even more gold. The ballroom pays for itself, emotionally.' ),
				array( 'room-constitution.jpg', 'The Constitution', 'The founding document, under glass, for now. Amend it. It was always more of a mood board than a rulebook.' ),
			);
			foreach ( $ad_rooms as $room ) : ?>
				<article class="feature reveal">
					<div class="feature-img"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/' . $room[0] ); ?>" alt="<?php echo esc_attr( $room[1] ); ?>" loading="lazy"></div>
					<h3><?php echo esc_html( $room[1] ); ?></h3>
					<p><?php echo esc_html( $room[2] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
// ---- The National Scream: latest posts ----
$ad_scream = new WP_Query( array( 'posts_per_page' => 3, 'ignore_sticky_posts' => true ) );
if ( $ad_scream->have_posts() ) : ?>
<section class="scream-band" id="scream">
	<div class="wrap">
		<div class="scream-masthead">
			<p class="kicker center reveal">Freshly screamed</p>
			<div class="scream-title reveal">The National Scream</div>
			<div class="scream-rule reveal"><span>The Paper of Record, Corrected</span></div>
		</div>
		<div class="scream-grid">
			<?php while ( $ad_scream->have_posts() ) : $ad_scream->the_post();
				$cats = get_the_category();
				?>
				<article class="scream-card reveal">
					<?php if ( $cats ) : ?><span class="cat"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="dek"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
					<div class="byline">By <?php the_author(); ?> &middot; <?php echo esc_html( get_the_date() ); ?></div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="scream-more">
			<a class="btn btn-line btn-big" href="<?php echo esc_url( ad_blog_url() ); ?>">Read the full Scream</a>
		</div>
	</div>
</section>
<?php endif;
wp_reset_postdata();
?>

<!-- Medals -->
<section class="section medals-band">
	<div class="wrap">
		<p class="kicker center reveal">Decorations of the Permanent Administration</p>
		<h2 class="center reveal">Medals You Will Award Yourself</h2>
		<p class="section-sub center reveal">Thirteen service medals, earned through play and presented to you, by you, at a ceremony you will describe as emotional.</p>
		<div class="medal-row reveal" id="medalRow">
			<?php
			$ad_medals = array(
				array( 'medal-eagle.png', 'Order of the Eagle' ),
				array( 'medal-dome.png', 'The Golden Dome' ),
				array( 'medal-gavel.png', 'The Bent Gavel' ),
				array( 'medal-money.png', 'The Cross of Liquidity' ),
				array( 'medal-swords.png', 'Crossed Swords of Restraint (never awarded)' ),
				array( 'medal-scales.png', 'The Adjusted Scales' ),
				array( 'medal-residence.png', 'The Residence Star' ),
				array( 'medal-key.png', 'The Key to Everything' ),
				array( 'medal-collapse.png', 'The Collapse Commendation (posthumous, usually)' ),
			);
			foreach ( $ad_medals as $m ) : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/medals/' . $m[0] ); ?>" alt="Medal: <?php echo esc_attr( $m[1] ); ?>" title="<?php echo esc_attr( $m[1] ); ?>" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Testimony -->
<section class="section testimony" id="testimony">
	<div class="wrap">
		<p class="kicker center reveal">Sworn statements</p>
		<h2 class="center reveal">The Cabinet Reviews the Game</h2>
		<p class="section-sub center reveal">All testimony given voluntarily, under oath, and in the presence of the President.</p>
		<div class="quote-grid">
			<?php
			$ad_quotes = array(
				array( 'I have served in four administrations. This is certainly one of them.', 'Deborah Krank, Chief of Staff' ),
				array( 'The game is perfect and always has been. Next question. No, not you.', 'Kaylee Bright, Press Secretary' ),
				array( 'engagement is INSANE rn. we ratio\'d the constitution. 🦅🦅🦅', 'Brayden, Director of Posting, age 19' ),
				array( 'I am legally required to appear on this website.', 'Cordelia Ruiz-Bloom, Opposition Leader' ),
				array( 'No comment.<br><small>(Comment provided on her behalf by the Seeing and Approving Office.)</small>', 'Winifred Stone, Chief Justice' ),
				array( 'Five stars. The number was chosen for me, but I want to be clear that I also mean it.', 'Gen. Mick Tarrant, Joint Chiefs' ),
			);
			foreach ( $ad_quotes as $q ) : ?>
				<blockquote class="quote reveal">
					<div class="stars">★★★★★</div>
					<p><?php echo wp_kses_post( $q[0] ); ?></p>
					<footer><?php echo esc_html( $q[1] ); ?></footer>
				</blockquote>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Patriot Store (satirical; the real shop is WooCommerce) -->
<section class="section store" id="store">
	<div class="wrap">
		<p class="kicker center reveal">Official merchandise of the Executive Branch</p>
		<h2 class="center reveal">The Patriot Store</h2>
		<p class="section-sub center reveal">"Sir. Respectfully. It is absolutely a store."<br><small>Sy Feltman, Personal Counsel to the President</small></p>
		<div class="store-grid">
			<article class="product reveal">
				<div class="product-art" aria-hidden="true"><img class="product-photo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/product-coin.jpg' ); ?>" alt="" loading="lazy"></div>
				<h3>$PREZ Coin</h3>
				<p class="product-sub">The official currency of loyalty</p>
				<p>A digital asset backed by the full faith and credit of a man who has neither. Number goes up while you are watching. Do not stop watching.</p>
				<div class="product-price"><span class="price-live" id="prezPrice">$0.0004</span> <span class="price-note" id="prezNote">▲ rising</span></div>
				<button class="btn btn-gold add-btn" data-product="$PREZ Coin" type="button">Buy the dip. And the rise.</button>
				<p class="product-fine">Not a security. Not secure. Not available.</p>
			</article>
			<article class="product reveal">
				<div class="product-art" aria-hidden="true"><img class="product-photo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/product-cologne.jpg' ); ?>" alt="" loading="lazy"></div>
				<h3>Eagle One, the Cologne</h3>
				<p class="product-sub">By Liberty Financial Fragrances</p>
				<p>3.4 fluid ounces of unregulated confidence. Top notes of mahogany and litigation. Base notes of a document you were not supposed to keep.</p>
				<div class="product-price">$88.00 <span class="price-note">tariff included, then added again</span></div>
				<button class="btn btn-gold add-btn" data-product="Eagle One" type="button">Smell like executive time</button>
				<p class="product-fine">Discontinued after the incident. The incident is classified.</p>
			</article>
			<article class="product reveal">
				<div class="product-art" aria-hidden="true"><img class="product-photo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/product-pardon.jpg' ); ?>" alt="" loading="lazy"></div>
				<h3>Commemorative Pardon</h3>
				<p class="product-sub">Framed. Suitable for framing again.</p>
				<p>A full and unconditional pardon with your name written in by hand. Not legally binding. For the legally binding version, please commit to a purchase of the game.</p>
				<div class="product-price">$1,776.00 <span class="price-note">crimes sold separately</span></div>
				<button class="btn btn-gold add-btn" data-product="Commemorative Pardon" type="button">Forgive yourself first</button>
				<p class="product-fine">Frame contains no gold. Gold contains no frame. All sales are final, like everything else now.</p>
			</article>
		</div>
		<p class="store-legal reveal">The Patriot Store does not ship, charge, or exist. Purchases are recorded as Tributes and remain, like all things, the property of the President.</p>
	</div>
</section>

<!-- Download -->
<section class="section download" id="download">
	<div class="download-bg" aria-hidden="true"></div>
	<div class="wrap">
		<p class="kicker center reveal">Distribution by decree</p>
		<h2 class="center reveal">Assume the Office</h2>
		<p class="section-sub center reveal">Coming soon. Fully offline. Collects nothing, which makes it the most private branch of government. Priced fairly, by a panel the President appointed.</p>
		<div class="dl-grid">
			<button class="dl-card reveal" type="button" data-toast="The Steam page is being prepared. Valve has not yet been informed, which is how we prefer our negotiations.">
				<span class="dl-icon" aria-hidden="true">🖥️</span>
				<b>Desktop</b>
				<span class="dl-sub">Windows and Mac, on Steam</span>
				<span class="dl-cta">Wishlist soon →</span>
			</button>
			<button class="dl-card reveal" type="button" data-toast="The App Store is reviewing our application. We are reviewing the App Store.">
				<span class="dl-icon" aria-hidden="true"></span>
				<b>iOS</b>
				<span class="dl-sub">App Store</span>
				<span class="dl-cta">In review →</span>
			</button>
			<button class="dl-card reveal" type="button" data-toast="Awaiting clearance from Google, an entity we have several thoughts about.">
				<span class="dl-icon" aria-hidden="true">🤖</span>
				<b>Android</b>
				<span class="dl-sub">Google Play</span>
				<span class="dl-cta">In review →</span>
			</button>
			<button class="dl-card reveal" type="button" data-toast="STOP. GAME COMING. STOP. AWAIT FURTHER INSTRUCTION. STOP. DO NOT STOP. STOP.">
				<span class="dl-icon" aria-hidden="true">📜</span>
				<b>Telegraph</b>
				<span class="dl-sub">For citizens of distinction</span>
				<span class="dl-cta">Request word →</span>
			</button>
		</div>
		<div class="sysreq reveal">
			<h4>System requirements</h4>
			<ul>
				<li><b>Minimum:</b> a device, ambition.</li>
				<li><b>Recommended:</b> a device, ambition, no working knowledge of constitutional law.</li>
				<li><b>Storage:</b> less space than one classified document.</li>
			</ul>
		</div>
	</div>
</section>

<!-- FAQ -->
<section class="section faq">
	<div class="wrap wrap-narrow">
		<p class="kicker center reveal">The Office of Questions</p>
		<h2 class="center reveal">Frequently Approved Questions</h2>
		<div class="faq-list">
			<?php
			$ad_faq = array(
				array( 'Is this game legal?', 'The Attorney General has advised us not to answer, and we have advised the Attorney General not to advise.' ),
				array( 'Is the game free?', 'No. Freedom is not free, and neither is this. The game costs money. The country pays separately.' ),
				array( 'When can I buy it?', 'Soon. The release date exists, is beautiful, and will be announced by the appropriate office once the office has been created.' ),
				array( 'How long is one term?', 'Forty-eight months, or about twenty minutes of real time, which is coincidentally how long a republic takes.' ),
				array( 'Is it really all fictional?', 'Yes. Every person, party, agency, company, and country in the game is invented. Any resemblance to persons living, dead, or currently posting is a coincidence we are extremely proud of.' ),
				array( 'Can I lose?', 'Constantly. Five institutions each have a way of ending you, and the election at the end has three doors. One of them only opens if you have gathered enough power to keep it shut.' ),
			);
			foreach ( $ad_faq as $f ) : ?>
				<details class="reveal">
					<summary><?php echo esc_html( $f[0] ); ?></summary>
					<p><?php echo esc_html( $f[1] ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
</main>

<?php get_footer();
