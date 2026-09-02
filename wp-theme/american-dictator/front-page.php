<?php
/**
 * Front page: the propaganda one-pager.
 *
 * @package American_Dictator
 */
get_header();

$ad_ticker = ( 'en' === ad_lang() )
	? ad_lines( 'ad_ticker_lines', array(
		'APPROVAL RATING REACHES 143 PERCENT, POLLSTER PROMOTED TO SAFETY',
		'COURTS AGREE WITH PRESIDENT IN RECORD TIME, JUDGES THANKED AND REPLACED',
		'HURRICANE CORRECTED BY EXECUTIVE ORDER, NOW HEADED WHERE IT WAS TOLD',
		'$PREZ COIN UP 40,000 PERCENT AMONG THOSE REQUIRED TO SAY SO',
		'PRESS SECRETARY TAKES QUESTIONS, KEEPS THEM',
		'ECONOMY DESCRIBED AS TREMENDOUS BY MAN WHO NOW OWNS IT',
		'FREEDOM OCEAN RENAMED AGAIN, OLD MAPS BURNED IN CELEBRATION',
		'ELECTION CONFIRMED FOR WHENEVER',
		'THIS HEADLINE APPROVED BEFORE IT WAS WRITTEN',
	) )
	: preg_split( '/\r\n|\r|\n/', ad_t( 'ticker.lines' ) );
$ad_ticker = array_values( array_filter( array_map( 'trim', (array) $ad_ticker ) ) );
?>

<main id="top">
<section class="hero">
	<div class="hero-bg" aria-hidden="true" style="background-image:url('<?php echo ad_img( 'ad_hero_image', 'hero-rally.jpg' ); ?>');"></div>
	<div class="hero-vignette" aria-hidden="true"></div>
	<div class="hero-inner">
		<img class="hero-seal" src="<?php echo ad_img( 'ad_seal', 'seal-512.png' ); ?>" alt="" width="132" height="132" aria-hidden="true">
		<p class="hero-kicker reveal"><?php echo esc_html( ad_tc( 'ad_hero_kicker', 'The Patriot Party presents', 'hero.kicker' ) ); ?></p>
		<h1 class="hero-title" aria-label="American Dictator">
			<span class="ht-line"><span>AMERICAN</span></span>
			<span class="ht-line ht-line2"><span>DICTATOR</span></span>
		</h1>
		<p class="hero-tag reveal"><?php echo wp_kses_post( ad_tc( 'ad_hero_tagline', 'One term. One chance. <b>Zero term limits.</b>', 'hero.tagline' ) ); ?></p>
		<p class="hero-sub reveal"><?php echo esc_html( ad_tc( 'ad_hero_sub', 'A satirical political survival game. A crisis lands on your desk every month. You get three bad options, one worse one, and a timer. Capture the courts, the Congress, and the press before the republic notices, or lose the only election you ever intend to hold.', 'hero.sub' ) ); ?></p>
		<div class="hero-ctas reveal">
			<a class="btn btn-gold btn-big" href="<?php echo esc_url( ad_mod( 'ad_cta_url', '#download' ) ); ?>"><?php echo esc_html( ad_tc( 'ad_cta_label', 'Coming soon. Prepare accordingly.', 'hero.cta' ) ); ?></a>
			<a class="btn btn-line btn-big" href="#machinery"><?php echo esc_html( ad_t( 'hero.cta2' ) ); ?></a>
		</div>
		<div class="hero-stats reveal">
			<div class="stat"><b class="stat-num" id="statApproval">0%</b><span><?php echo esc_html( ad_t( 'hero.stat.approval' ) ); ?><sup>*</sup></span></div>
			<div class="stat"><b class="stat-num" id="statCrises">0</b><span><?php echo esc_html( ad_t( 'hero.stat.crises' ) ); ?></span></div>
			<div class="stat"><b class="stat-num" id="statTerms">1</b><span><?php echo esc_html( ad_t( 'hero.stat.terms' ) ); ?></span></div>
		</div>
		<p class="hero-fine reveal"><sup>*</sup><?php echo esc_html( ad_t( 'hero.fine' ) ); ?></p>
	</div>
	<div class="hero-podium-note" aria-hidden="true"><span><?php echo esc_html( ad_t( 'hero.podium' ) ); ?></span></div>
</section>

<!-- News ticker -->
<div class="ticker" aria-label="Headlines from The National Scream">
	<div class="ticker-label"><?php echo esc_html( ad_t( 'ticker.label' ) ); ?></div>
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
				<img id="presidentPortrait" src="<?php echo ad_img( 'ad_portrait_male', 'portrait-male.jpg' ); ?>" data-alt="<?php echo ad_img( 'ad_portrait_female', 'portrait-female.jpg' ); ?>" alt="American Dictator: the official state portrait" loading="lazy">
			</div>
			<figcaption><?php echo esc_html( ad_tc( 'ad_portrait_caption', "The official state portrait, painted from the President's best angle.", 'letter.caption' ) ); ?></figcaption>
		</figure>
		<div class="mandate-copy">
			<p class="kicker reveal"><?php echo esc_html( ad_t( 'mandate.kicker' ) ); ?></p>
			<h2 class="reveal"><?php echo wp_kses_post( ad_tc( 'ad_letter_heading', "\"It's good to be<br>the President.\"", 'letter.heading' ) ); ?></h2>
			<div class="letter reveal">
				<?php
				$ad_letter_default = '<p>My fellow Americans. When I took this office, our country had problems. Big problems. Courts that said no. Newspapers that printed things. A Congress.</p><p>I made you a promise: I would fix all of it, or I would fix the people who noticed. In this game, that promise is yours to keep. You will inherit five institutions in working order, and you will have forty-eight months to do something about that.</p><p>They call it a democracy simulator. It is not. Democracy is what happens when you lose.</p><p class="letter-sign">The President<br><small>(name withheld for legal reasons that are also withheld)</small></p>';
				echo wp_kses_post( ad_tc( 'ad_letter_body', $ad_letter_default, 'letter.body' ) );
				?>
			</div>
			<div class="seal-stamp reveal" aria-hidden="true"><img src="<?php echo ad_img( 'ad_seal', 'seal-192.png' ); ?>" alt=""><span><?php echo wp_kses_post( ad_t( 'letter.stamp' ) ); ?></span></div>
		</div>
	</div>
</section>

<!-- Gold plaque divider -->
<section class="plaque-band" aria-hidden="true">
	<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/plaque.jpg' ); ?>" alt="" loading="lazy">
	<div class="plaque-caption"><span><?php echo esc_html( ad_t( 'plaque.caption' ) ); ?></span></div>
</section>

<!-- The Machinery -->
<section class="section machinery" id="machinery">
	<div class="wrap">
		<p class="kicker center reveal"><?php echo esc_html( ad_t( 'mach.kicker' ) ); ?></p>
		<h2 class="center reveal"><?php echo esc_html( ad_t( 'mach.h' ) ); ?></h2>
		<p class="section-sub center reveal"><?php echo esc_html( ad_t( 'mach.sub' ) ); ?></p>
		<div class="feature-grid">
			<?php
			$ad_rooms = array(
				array( 'room-press.jpg', 'room.press' ),
				array( 'room-courts.jpg', 'room.bench' ),
				array( 'room-war.jpg', 'room.war' ),
				array( 'room-street.jpg', 'room.street' ),
				array( 'room-economy.jpg', 'room.economy' ),
				array( 'room-pardon.jpg', 'room.pardon' ),
				array( 'room-call.jpg', 'room.phone' ),
				array( 'room-residence.jpg', 'room.residence' ),
				array( 'room-constitution.jpg', 'room.constitution' ),
			);
			foreach ( $ad_rooms as $room ) : ?>
				<article class="feature reveal">
					<div class="feature-img"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/' . $room[0] ); ?>" alt="<?php echo esc_attr( ad_t( $room[1] . '.h' ) ); ?>" loading="lazy"></div>
					<h3><?php echo esc_html( ad_t( $room[1] . '.h' ) ); ?></h3>
					<p><?php echo esc_html( ad_t( $room[1] . '.p' ) ); ?></p>
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
			<p class="kicker center reveal"><?php echo esc_html( ad_t( 'scream.kicker' ) ); ?></p>
			<div class="scream-title reveal"><?php echo esc_html( ad_t( 'scream.h' ) ); ?></div>
			<div class="scream-rule reveal"><span><?php echo esc_html( ad_t( 'scream.rule' ) ); ?></span></div>
		</div>
		<div class="scream-grid">
			<?php while ( $ad_scream->have_posts() ) : $ad_scream->the_post();
				$cats = get_the_category();
				?>
				<article class="scream-card reveal">
					<?php if ( $cats ) : ?><span class="cat"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
					<h3><a href="<?php echo esc_url( ad_localize_url( get_permalink() ) ); ?>"><?php the_title(); ?></a></h3>
					<p class="dek"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
					<div class="byline"><?php echo esc_html( ad_t( 'scream.by' ) ); ?> <?php the_author(); ?> &middot; <?php echo esc_html( get_the_date() ); ?></div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="scream-more">
			<a class="btn btn-line btn-big" href="<?php echo esc_url( ad_localize_url( ad_blog_url() ) ); ?>"><?php echo esc_html( ad_t( 'scream.more' ) ); ?></a>
		</div>
	</div>
</section>
<?php endif;
wp_reset_postdata();
?>

<!-- Medals -->
<section class="section medals-band">
	<div class="wrap">
		<p class="kicker center reveal"><?php echo esc_html( ad_t( 'medals.kicker' ) ); ?></p>
		<h2 class="center reveal"><?php echo esc_html( ad_t( 'medals.h' ) ); ?></h2>
		<p class="section-sub center reveal"><?php echo esc_html( ad_t( 'medals.sub' ) ); ?></p>
		<div class="medal-row reveal" id="medalRow">
			<?php
			$ad_medals = array(
				array( 'medal-eagle.png', 'Order of the Eagle' ),
				array( 'medal-dome.png', 'The Golden Dome' ),
				array( 'medal-gavel.png', 'The Bent Gavel' ),
				array( 'medal-money.png', 'The Cross of Liquidity' ),
				array( 'medal-swords.png', 'Crossed Swords of Restraint' ),
				array( 'medal-scales.png', 'The Adjusted Scales' ),
				array( 'medal-residence.png', 'The Residence Star' ),
				array( 'medal-key.png', 'The Key to Everything' ),
				array( 'medal-collapse.png', 'The Collapse Commendation' ),
			);
			foreach ( $ad_medals as $m ) : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/medals/' . $m[0] ); ?>" alt="<?php echo esc_attr( $m[1] ); ?>" title="<?php echo esc_attr( $m[1] ); ?>" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Testimony -->
<section class="section testimony" id="testimony">
	<div class="wrap">
		<p class="kicker center reveal"><?php echo esc_html( ad_t( 'test.kicker' ) ); ?></p>
		<h2 class="center reveal"><?php echo esc_html( ad_t( 'test.h' ) ); ?></h2>
		<p class="section-sub center reveal"><?php echo esc_html( ad_t( 'test.sub' ) ); ?></p>
		<div class="quote-grid">
			<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
				<blockquote class="quote reveal">
					<div class="stars">★★★★★</div>
					<p><?php echo wp_kses_post( ad_t( 'test.q' . $i ) ); ?></p>
					<footer><?php echo esc_html( ad_t( 'test.a' . $i ) ); ?></footer>
				</blockquote>
			<?php endfor; ?>
		</div>
	</div>
</section>

<!-- Patriot Store (satirical; the real shop is WooCommerce) -->
<section class="section store" id="store">
	<div class="wrap">
		<p class="kicker center reveal"><?php echo esc_html( ad_t( 'store.kicker' ) ); ?></p>
		<h2 class="center reveal"><?php echo esc_html( ad_t( 'store.h' ) ); ?></h2>
		<p class="section-sub center reveal"><?php echo esc_html( ad_t( 'store.sub' ) ); ?><br><small><?php echo esc_html( ad_t( 'store.subby' ) ); ?></small></p>
		<div class="store-grid">
			<article class="product reveal">
				<div class="product-art" aria-hidden="true"><img class="product-photo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/product-coin.jpg' ); ?>" alt="" loading="lazy"></div>
				<h3><?php echo esc_html( ad_t( 'store.coin.h' ) ); ?></h3>
				<p class="product-sub"><?php echo esc_html( ad_t( 'store.coin.sub' ) ); ?></p>
				<p><?php echo esc_html( ad_t( 'store.coin.p' ) ); ?></p>
				<div class="product-price"><span class="price-live" id="prezPrice">$0.0004</span> <span class="price-note" id="prezNote"><?php echo esc_html( ad_t( 'store.coin.note' ) ); ?></span></div>
				<button class="btn btn-gold add-btn" data-product="$PREZ Coin" type="button"><?php echo esc_html( ad_t( 'store.coin.btn' ) ); ?></button>
				<p class="product-fine"><?php echo esc_html( ad_t( 'store.coin.fine' ) ); ?></p>
			</article>
			<article class="product reveal">
				<div class="product-art" aria-hidden="true"><img class="product-photo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/product-cologne.jpg' ); ?>" alt="" loading="lazy"></div>
				<h3><?php echo esc_html( ad_t( 'store.cologne.h' ) ); ?></h3>
				<p class="product-sub"><?php echo esc_html( ad_t( 'store.cologne.sub' ) ); ?></p>
				<p><?php echo esc_html( ad_t( 'store.cologne.p' ) ); ?></p>
				<div class="product-price"><?php echo esc_html( ad_t( 'store.cologne.price' ) ); ?> <span class="price-note"><?php echo esc_html( ad_t( 'store.cologne.note' ) ); ?></span></div>
				<button class="btn btn-gold add-btn" data-product="Eagle One" type="button"><?php echo esc_html( ad_t( 'store.cologne.btn' ) ); ?></button>
				<p class="product-fine"><?php echo esc_html( ad_t( 'store.cologne.fine' ) ); ?></p>
			</article>
			<article class="product reveal">
				<div class="product-art" aria-hidden="true"><img class="product-photo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/product-pardon.jpg' ); ?>" alt="" loading="lazy"></div>
				<h3><?php echo esc_html( ad_t( 'store.pardon.h' ) ); ?></h3>
				<p class="product-sub"><?php echo esc_html( ad_t( 'store.pardon.sub' ) ); ?></p>
				<p><?php echo esc_html( ad_t( 'store.pardon.p' ) ); ?></p>
				<div class="product-price">$1,776.00 <span class="price-note"><?php echo esc_html( ad_t( 'store.pardon.note' ) ); ?></span></div>
				<button class="btn btn-gold add-btn" data-product="Commemorative Pardon" type="button"><?php echo esc_html( ad_t( 'store.pardon.btn' ) ); ?></button>
				<p class="product-fine"><?php echo esc_html( ad_t( 'store.pardon.fine' ) ); ?></p>
			</article>
		</div>
		<p class="store-legal reveal"><?php echo esc_html( ad_t( 'store.legal' ) ); ?></p>
	</div>
</section>

<!-- Download -->
<section class="section download" id="download">
	<div class="download-bg" aria-hidden="true"></div>
	<div class="wrap">
		<p class="kicker center reveal"><?php echo esc_html( ad_t( 'dl.kicker' ) ); ?></p>
		<h2 class="center reveal"><?php echo esc_html( ad_t( 'dl.h' ) ); ?></h2>
		<p class="section-sub center reveal"><?php echo esc_html( ad_t( 'dl.sub' ) ); ?></p>
		<div class="dl-grid">
			<button class="dl-card reveal" type="button" data-toast="<?php echo esc_attr( ad_t( 'dl.desktop.toast' ) ); ?>">
				<span class="dl-icon" aria-hidden="true">🖥️</span>
				<b><?php echo esc_html( ad_t( 'dl.desktop.b' ) ); ?></b>
				<span class="dl-sub"><?php echo esc_html( ad_t( 'dl.desktop.sub' ) ); ?></span>
				<span class="dl-cta"><?php echo esc_html( ad_t( 'dl.desktop.cta' ) ); ?></span>
			</button>
			<button class="dl-card reveal" type="button" data-toast="<?php echo esc_attr( ad_t( 'dl.ios.toast' ) ); ?>">
				<span class="dl-icon" aria-hidden="true"></span>
				<b><?php echo esc_html( ad_t( 'dl.ios.b' ) ); ?></b>
				<span class="dl-sub"><?php echo esc_html( ad_t( 'dl.ios.sub' ) ); ?></span>
				<span class="dl-cta"><?php echo esc_html( ad_t( 'dl.ios.cta' ) ); ?></span>
			</button>
			<button class="dl-card reveal" type="button" data-toast="<?php echo esc_attr( ad_t( 'dl.android.toast' ) ); ?>">
				<span class="dl-icon" aria-hidden="true">🤖</span>
				<b><?php echo esc_html( ad_t( 'dl.android.b' ) ); ?></b>
				<span class="dl-sub"><?php echo esc_html( ad_t( 'dl.android.sub' ) ); ?></span>
				<span class="dl-cta"><?php echo esc_html( ad_t( 'dl.android.cta' ) ); ?></span>
			</button>
			<button class="dl-card reveal" type="button" data-toast="<?php echo esc_attr( ad_t( 'dl.tel.toast' ) ); ?>">
				<span class="dl-icon" aria-hidden="true">📜</span>
				<b><?php echo esc_html( ad_t( 'dl.tel.b' ) ); ?></b>
				<span class="dl-sub"><?php echo esc_html( ad_t( 'dl.tel.sub' ) ); ?></span>
				<span class="dl-cta"><?php echo esc_html( ad_t( 'dl.tel.cta' ) ); ?></span>
			</button>
		</div>
		<div class="sysreq reveal">
			<h4><?php echo esc_html( ad_t( 'dl.sysreq' ) ); ?></h4>
			<ul>
				<li><?php echo wp_kses_post( ad_t( 'dl.req1' ) ); ?></li>
				<li><?php echo wp_kses_post( ad_t( 'dl.req2' ) ); ?></li>
				<li><?php echo wp_kses_post( ad_t( 'dl.req3' ) ); ?></li>
			</ul>
		</div>
	</div>
</section>

<!-- FAQ -->
<section class="section faq">
	<div class="wrap wrap-narrow">
		<p class="kicker center reveal"><?php echo esc_html( ad_t( 'faq.kicker' ) ); ?></p>
		<h2 class="center reveal"><?php echo esc_html( ad_t( 'faq.h' ) ); ?></h2>
		<div class="faq-list">
			<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
				<details class="reveal">
					<summary><?php echo esc_html( ad_t( 'faq.q' . $i ) ); ?></summary>
					<p><?php echo esc_html( ad_t( 'faq.a' . $i ) ); ?></p>
				</details>
			<?php endfor; ?>
		</div>
	</div>
</section>
</main>

<?php get_footer();
