<?php
/**
 * Lightweight i18n for the theme, mirroring the game's approach:
 * a string table per language, English as the base, and fallback to English
 * for anything a translation omits (so a partial translation is always safe).
 *
 * Language is chosen by the ?lang=xx query parameter so every language has its
 * own cacheable URL (works cleanly with LiteSpeed page cache) and can carry
 * hreflang for SEO. No parameter = English (the canonical URL).
 *
 * @package American_Dictator
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** The languages offered, matching the game. `native` shows in its own script. */
function ad_languages() {
	return array(
		'en' => array( 'native' => 'English',    'flag' => '🇺🇸', 'hreflang' => 'en' ),
		'zh' => array( 'native' => '中文',        'flag' => '🇨🇳', 'hreflang' => 'zh-Hans' ),
		'es' => array( 'native' => 'Español',    'flag' => '🇪🇸', 'hreflang' => 'es' ),
		'fr' => array( 'native' => 'Français',   'flag' => '🇫🇷', 'hreflang' => 'fr' ),
		'de' => array( 'native' => 'Deutsch',    'flag' => '🇩🇪', 'hreflang' => 'de' ),
		'pt' => array( 'native' => 'Português',  'flag' => '🇵🇹', 'hreflang' => 'pt' ),
		'it' => array( 'native' => 'Italiano',   'flag' => '🇮🇹', 'hreflang' => 'it' ),
		'nl' => array( 'native' => 'Nederlands', 'flag' => '🇳🇱', 'hreflang' => 'nl' ),
		'pl' => array( 'native' => 'Polski',     'flag' => '🇵🇱', 'hreflang' => 'pl' ),
		'cs' => array( 'native' => 'Čeština',    'flag' => '🇨🇿', 'hreflang' => 'cs' ),
		'ru' => array( 'native' => 'Русский',    'flag' => '🇷🇺', 'hreflang' => 'ru' ),
	);
}

/** The active language code for this request (validated, default 'en'). */
function ad_lang() {
	static $lang = null;
	if ( null !== $lang ) {
		return $lang;
	}
	$req = isset( $_GET['lang'] ) ? sanitize_key( wp_unslash( $_GET['lang'] ) ) : '';
	$lang = array_key_exists( $req, ad_languages() ) ? $req : 'en';
	return $lang;
}

/** Append the current language to an internal URL so navigation keeps the language. */
function ad_localize_url( $url ) {
	$lang = ad_lang();
	if ( 'en' === $lang ) {
		return $url;
	}
	return add_query_arg( 'lang', $lang, $url );
}

/** The same URL in a given language (for the switcher and hreflang). */
function ad_url_in_lang( $code ) {
	$current = home_url( add_query_arg( array() ) ); // current URL without changing anything
	$current = remove_query_arg( 'lang', $current );
	return ( 'en' === $code ) ? $current : add_query_arg( 'lang', $code, $current );
}

/**
 * Translate a key. Falls back active -> English -> the key itself, then fills
 * {placeholders} from $vars. Never throws on a missing key. HTML in values is
 * intentional (short inline tags), so callers echo the result directly.
 */
function ad_t( $key, $vars = array() ) {
	static $tables = null;
	if ( null === $tables ) {
		$tables = array( 'en' => ad_i18n_en() );
		$dir    = get_template_directory() . '/inc/lang/';
		foreach ( array_keys( ad_languages() ) as $code ) {
			if ( 'en' === $code ) {
				continue;
			}
			$file = $dir . $code . '.php';
			if ( is_readable( $file ) ) {
				$data = include $file;
				if ( is_array( $data ) ) {
					$tables[ $code ] = $data;
				}
			}
		}
	}
	$lang = ad_lang();
	$s    = isset( $tables[ $lang ][ $key ] ) ? $tables[ $lang ][ $key ]
		: ( isset( $tables['en'][ $key ] ) ? $tables['en'][ $key ] : $key );
	if ( $vars ) {
		foreach ( $vars as $k => $v ) {
			$s = str_replace( '{' . $k . '}', $v, $s );
		}
	}
	return $s;
}

/**
 * Customizer-or-translation bridge: in English use the (editable) Customizer
 * value; in any other language use the translation table.
 */
function ad_tc( $mod_key, $mod_default, $i18n_key ) {
	if ( 'en' === ad_lang() ) {
		return ad_mod( $mod_key, $mod_default );
	}
	return ad_t( $i18n_key );
}

/* ---------------------------------------------------------------------------
 * The English base table. Every key the templates use lives here; translation
 * files (inc/lang/<code>.php) override any subset of these.
 * ------------------------------------------------------------------------- */
function ad_i18n_en() {
	return array(
		/* seo */
		'seo.description' => 'American Dictator is a satirical political survival game. You get one four-year term to turn a republic into a dictatorship. Coming soon.',

		/* chrome */
		'gov.banner'   => 'An official website of the Patriot Party.',
		'gov.how'      => "Here's how you know",
		'gov.answer'   => 'You know because we are telling you, and we have never been wrong. See headline, below, about how we have never been wrong.',
		'nav.mandate'  => 'The Mandate',
		'nav.machinery' => 'The Machinery',
		'nav.scream'   => 'The National Scream',
		'nav.store'    => 'Patriot Store',
		'nav.download' => 'Download',
		'nav.tributes' => 'Tributes:',
		'nav.seize'    => 'Seize Power',
		'lang.label'   => 'Language',

		/* hero */
		'hero.kicker'  => 'The Patriot Party presents',
		'hero.tagline' => 'One term. One chance. <b>Zero term limits.</b>',
		'hero.sub'     => 'A satirical political survival game. A crisis lands on your desk every month. You get three bad options, one worse one, and a timer. Capture the courts, the Congress, and the press before the republic notices, or lose the only election you ever intend to hold.',
		'hero.cta'     => 'Coming soon. Prepare accordingly.',
		'hero.cta2'    => 'Inspect the machinery',
		'hero.stat.approval' => 'Approval rating',
		'hero.stat.crises'   => 'Hand-written crises',
		'hero.stat.terms'    => 'Term (so far)',
		'hero.fine'    => "Figure audited by the President's pollster, who is doing great and has not been threatened.",
		'hero.podium'  => 'The podium is empty. It is waiting for you.',
		'ticker.label' => 'THE NATIONAL SCREAM',
		'ticker.lines' => "APPROVAL RATING REACHES 143 PERCENT, POLLSTER PROMOTED TO SAFETY\nCOURTS AGREE WITH PRESIDENT IN RECORD TIME, JUDGES THANKED AND REPLACED\nHURRICANE CORRECTED BY EXECUTIVE ORDER, NOW HEADED WHERE IT WAS TOLD\n\$PREZ COIN UP 40,000 PERCENT AMONG THOSE REQUIRED TO SAY SO\nPRESS SECRETARY TAKES QUESTIONS, KEEPS THEM\nECONOMY DESCRIBED AS TREMENDOUS BY MAN WHO NOW OWNS IT\nFREEDOM OCEAN RENAMED AGAIN, OLD MAPS BURNED IN CELEBRATION\nELECTION CONFIRMED FOR WHENEVER\nTHIS HEADLINE APPROVED BEFORE IT WAS WRITTEN",

		/* mandate / letter */
		'mandate.kicker' => 'A message from the President',
		'letter.heading' => "\"It's good to be<br>the President.\"",
		'letter.body'    => '<p>My fellow Americans. When I took this office, our country had problems. Big problems. Courts that said no. Newspapers that printed things. A Congress.</p><p>I made you a promise: I would fix all of it, or I would fix the people who noticed. In this game, that promise is yours to keep. You will inherit five institutions in working order, and you will have forty-eight months to do something about that.</p><p>They call it a democracy simulator. It is not. Democracy is what happens when you lose.</p><p class="letter-sign">The President<br><small>(name withheld for legal reasons that are also withheld)</small></p>',
		'letter.caption' => "The official state portrait, painted from the President's best angle.",
		'letter.stamp'   => 'SEEN AND APPROVED<br>BY THE SEEING AND<br>APPROVING OFFICE',
		'plaque.caption' => 'THE GREAT SEAL OF DOING TREMENDOUSLY WELL',

		/* machinery */
		'mach.kicker' => 'Every lever of government, within reach',
		'mach.h'      => 'The Machinery of State',
		'mach.sub'    => 'Nine rooms. Each one runs a branch of the country. Each one can be persuaded, purchased, or permanently improved.',
		'room.press.h'   => 'The Press Room',
		'room.press.p'   => 'Twelve outlets stand between you and the truth, which is whatever you said this morning. Sue them, buy them, or turn them into fans. Freedom of the press includes your freedom to own one.',
		'room.bench.h'   => 'The Bench',
		'room.bench.p'   => 'Ten judges and a lot of opinions. They can be pressured, replaced, or simply outnumbered. If the court keeps ruling against you, the problem is obviously the size of the court.',
		'room.war.h'     => 'The War Room',
		'room.war.p'     => 'Declare war on anyone, for any reason. Glacia looked at you funny. The Hermit Republic exists. The map on the table is mostly red pins now, and the general has started sighing audibly.',
		'room.street.h'  => 'Public Order',
		'room.street.p'  => "Ten cities, each with its own opinion of you, each wrong. Send in the agencies until morale improves. Unrest is just approval that hasn't been processed yet.",
		'room.economy.h' => 'The Treasury',
		'room.economy.p' => 'Print money. Rename money. Put your face on money. The economy is the strongest it has ever been, according to the man it now legally belongs to.',
		'room.pardon.h'  => 'The Pardon Window',
		'room.pardon.p'  => 'Forgiveness, wholesale. Pardon allies, strangers, a horse, and eventually, in a private ceremony with excellent catering, yourself.',
		'room.phone.h'   => 'The Phone',
		'room.phone.p'   => 'An address book of world leaders and five things you can say to each of them, none of them wise. Every call is perfect. Ask anyone who is still allowed to describe it.',
		'room.residence.h' => 'The Residence',
		'room.residence.p' => "Thirteen improvements to the People's House, starting with more gold and proceeding directly to even more gold. The ballroom pays for itself, emotionally.",
		'room.constitution.h' => 'The Constitution',
		'room.constitution.p' => 'The founding document, under glass, for now. Amend it. It was always more of a mood board than a rulebook.',

		/* national scream (front) */
		'scream.kicker' => 'Freshly screamed',
		'scream.h'      => 'The National Scream',
		'scream.rule'   => 'The Paper of Record, Corrected',
		'scream.more'   => 'Read the full Scream',
		'scream.by'     => 'By',

		/* medals */
		'medals.kicker' => 'Decorations of the Permanent Administration',
		'medals.h'      => 'Medals You Will Award Yourself',
		'medals.sub'    => 'Thirteen service medals, earned through play and presented to you, by you, at a ceremony you will describe as emotional.',

		/* testimony */
		'test.kicker' => 'Sworn statements',
		'test.h'      => 'The Cabinet Reviews the Game',
		'test.sub'    => 'All testimony given voluntarily, under oath, and in the presence of the President.',
		'test.q1' => 'I have served in four administrations. This is certainly one of them.',
		'test.a1' => 'Deborah Krank, Chief of Staff',
		'test.q2' => 'The game is perfect and always has been. Next question. No, not you.',
		'test.a2' => 'Kaylee Bright, Press Secretary',
		'test.q3' => "engagement is INSANE rn. we ratio'd the constitution. 🦅🦅🦅",
		'test.a3' => 'Brayden, Director of Posting, age 19',
		'test.q4' => 'I am legally required to appear on this website.',
		'test.a4' => 'Cordelia Ruiz-Bloom, Opposition Leader',
		'test.q5' => 'No comment.<br><small>(Comment provided on her behalf by the Seeing and Approving Office.)</small>',
		'test.a5' => 'Winifred Stone, Chief Justice',
		'test.q6' => 'Five stars. The number was chosen for me, but I want to be clear that I also mean it.',
		'test.a6' => 'Gen. Mick Tarrant, Joint Chiefs',

		/* store */
		'store.kicker' => 'Official merchandise of the Executive Branch',
		'store.h'      => 'The Patriot Store',
		'store.sub'    => '"Sir. Respectfully. It is absolutely a store."',
		'store.subby'  => 'Sy Feltman, Personal Counsel to the President',
		'store.coin.h'    => '$PREZ Coin',
		'store.coin.sub'  => 'The official currency of loyalty',
		'store.coin.p'    => 'A digital asset backed by the full faith and credit of a man who has neither. Number goes up while you are watching. Do not stop watching.',
		'store.coin.note' => '▲ rising',
		'store.coin.btn'  => 'Buy the dip. And the rise.',
		'store.coin.fine' => 'Not a security. Not secure. Not available.',
		'store.cologne.h'    => 'Eagle One, the Cologne',
		'store.cologne.sub'  => 'By Liberty Financial Fragrances',
		'store.cologne.p'    => '3.4 fluid ounces of unregulated confidence. Top notes of mahogany and litigation. Base notes of a document you were not supposed to keep.',
		'store.cologne.price' => '$88.00',
		'store.cologne.note' => 'tariff included, then added again',
		'store.cologne.btn'  => 'Smell like executive time',
		'store.cologne.fine' => 'Discontinued after the incident. The incident is classified.',
		'store.pardon.h'    => 'Commemorative Pardon',
		'store.pardon.sub'  => 'Framed. Suitable for framing again.',
		'store.pardon.p'    => 'A full and unconditional pardon with your name written in by hand. Not legally binding. For the legally binding version, please commit to a purchase of the game.',
		'store.pardon.note' => 'crimes sold separately',
		'store.pardon.btn'  => 'Forgive yourself first',
		'store.pardon.fine' => 'Frame contains no gold. Gold contains no frame. All sales are final, like everything else now.',
		'store.legal' => 'The Patriot Store does not ship, charge, or exist. Purchases are recorded as Tributes and remain, like all things, the property of the President.',

		/* download */
		'dl.kicker' => 'Distribution by decree',
		'dl.h'      => 'Assume the Office',
		'dl.sub'    => 'Coming soon. Fully offline. Collects nothing, which makes it the most private branch of government. Priced fairly, by a panel the President appointed.',
		'dl.desktop.b'   => 'Desktop',
		'dl.desktop.sub' => 'Windows and Mac, on Steam',
		'dl.desktop.cta' => 'Wishlist soon →',
		'dl.desktop.toast' => 'The Steam page is being prepared. Valve has not yet been informed, which is how we prefer our negotiations.',
		'dl.ios.b'   => 'iOS',
		'dl.ios.sub' => 'App Store',
		'dl.ios.cta' => 'In review →',
		'dl.ios.toast' => 'The App Store is reviewing our application. We are reviewing the App Store.',
		'dl.android.b'   => 'Android',
		'dl.android.sub' => 'Google Play',
		'dl.android.cta' => 'In review →',
		'dl.android.toast' => 'Awaiting clearance from Google, an entity we have several thoughts about.',
		'dl.tel.b'   => 'Telegraph',
		'dl.tel.sub' => 'For citizens of distinction',
		'dl.tel.cta' => 'Request word →',
		'dl.tel.toast' => 'STOP. GAME COMING. STOP. AWAIT FURTHER INSTRUCTION. STOP. DO NOT STOP. STOP.',
		'dl.sysreq'  => 'System requirements',
		'dl.req1'    => '<b>Minimum:</b> a device, ambition.',
		'dl.req2'    => '<b>Recommended:</b> a device, ambition, no working knowledge of constitutional law.',
		'dl.req3'    => '<b>Storage:</b> less space than one classified document.',

		/* faq */
		'faq.kicker' => 'The Office of Questions',
		'faq.h'      => 'Frequently Approved Questions',
		'faq.q1' => 'Is this game legal?',
		'faq.a1' => 'The Attorney General has advised us not to answer, and we have advised the Attorney General not to advise.',
		'faq.q2' => 'Is the game free?',
		'faq.a2' => 'No. Freedom is not free, and neither is this. The game costs money. The country pays separately.',
		'faq.q3' => 'When can I buy it?',
		'faq.a3' => 'Soon. The release date exists, is beautiful, and will be announced by the appropriate office once the office has been created.',
		'faq.q4' => 'How long is one term?',
		'faq.a4' => 'Forty-eight months, or about twenty minutes of real time, which is coincidentally how long a republic takes.',
		'faq.q5' => 'Is it really all fictional?',
		'faq.a5' => 'Yes. Every person, party, agency, company, and country in the game is invented. Any resemblance to persons living, dead, or currently posting is a coincidence we are extremely proud of.',
		'faq.q6' => 'Can I lose?',
		'faq.a6' => 'Constantly. Five institutions each have a way of ending you, and the election at the end has three doors. One of them only opens if you have gathered enough power to keep it shut.',

		/* footer */
		'foot.motto'  => 'E PLURIBUS ME',
		'foot.satire' => '<b>American Dictator is a work of satire.</b> Every person, party, agency, court, company, and country in the game and on this website is fictional. No real person is depicted, named, or endorsed, and no real products are for sale, especially the pardon.',
		'foot.lines'  => 'Paid for by the Committee to Re-Elect the President, Forever. &middot; Not paid for, actually. &middot; This website collects no data. It simply assumes.',
		'foot.game'   => 'The game, coming soon',
		'foot.scream' => 'The National Scream',
		'foot.top'    => 'Return to the top, by order of the top',
		'foot.copy'   => 'American Dictator. All rights reserved, then expanded.',

		/* blog + 404 chrome */
		'blog.back'       => 'Return to the Office',
		'blog.backscream' => 'Back to The National Scream',
		'scream.tagline'  => 'The Paper of Record, Corrected · Est. Whenever',
		'scream.empty.h'  => 'No news is good news.',
		'scream.empty.p'  => 'The Scream has nothing to report, which the Administration considers its finest edition yet.',
		'archive.empty.h' => 'Nothing on file.',
		'archive.empty.p' => 'The record you seek has been reclassified, redacted, or was never permitted to exist. The Administration thanks you for your curiosity and has noted it.',
		'filed.under'     => 'Filed under',
		'search.prefix'   => 'Search:',
		'e404.h'    => 'Page 404: Reassigned',
		'e404.meta' => 'Filed by the Ministry of Missing Things',
		'e404.p1'   => 'The page you requested has been reassigned to the Freedom Ocean, along with the person who wrote it. This is not a mistake. Mistakes are not made here.',
		'e404.p2'   => 'You may return to the Office and pretend this never happened. We already have.',
		'e404.btn'  => 'Return to the Office',
	);
}
