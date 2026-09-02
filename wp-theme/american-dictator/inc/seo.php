<?php
/**
 * SEO: titles, meta description, Open Graph, Twitter, favicon, schema.
 * Baked into the theme so the whole site is optimised for "American Dictator"
 * without depending on an SEO plugin (which would fight over the title tag).
 *
 * @package American_Dictator
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const AD_SITE_NAME = 'American Dictator';
const AD_KEYWORDS  = 'American Dictator, American Dictator game, dictator simulator, political satire game, political survival game, satirical strategy game, Patriot Party, presidency game';

/** Front-page marketing description, reused for the homepage and as a fallback. */
function ad_default_description() {
	return 'American Dictator is a satirical political survival game. You get one four-year term to turn a republic into a dictatorship. Coming soon.';
}

/** Best description for the current view (trimmed to ~160 chars). */
function ad_meta_description() {
	$desc = ad_default_description();
	if ( is_singular() && ! is_front_page() ) {
		$post = get_queried_object();
		if ( $post && ! empty( $post->post_excerpt ) ) {
			$desc = $post->post_excerpt;
		} elseif ( $post ) {
			$desc = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
		}
	} elseif ( is_home() && ! is_front_page() ) {
		$desc = 'The National Scream, the official newspaper of American Dictator: satirical headlines from the Permanent Administration.';
	} elseif ( is_archive() ) {
		$desc = wp_strip_all_tags( get_the_archive_description() ) ?: ad_default_description();
	}
	$desc = trim( preg_replace( '/\s+/', ' ', $desc ) );
	if ( mb_strlen( $desc ) > 160 ) {
		$desc = mb_substr( $desc, 0, 157 ) . '&hellip;';
	}
	return $desc;
}

/** Canonical URL for the current view. */
function ad_canonical() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		return get_permalink();
	}
	if ( is_home() && get_option( 'page_for_posts' ) ) {
		return get_permalink( get_option( 'page_for_posts' ) );
	}
	$link = home_url( add_query_arg( array(), $GLOBALS['wp']->request ) );
	return $link ? trailingslashit( $link ) : home_url( '/' );
}

/** The share/OG image (post thumbnail if present, else the theme default). */
function ad_share_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		if ( $src ) {
			return $src[0];
		}
	}
	return get_template_directory_uri() . '/assets/og-image.jpg';
}

/* ---------------------------------------------------------------------------
 * Title tag
 * ------------------------------------------------------------------------- */
add_filter( 'document_title_separator', function () {
	return '|';
} );

add_filter( 'document_title_parts', function ( $parts ) {
	if ( is_front_page() ) {
		$parts = array(
			'title'   => AD_SITE_NAME,
			'tagline' => 'The Satirical Political Survival Game',
		);
	} elseif ( is_home() ) {
		$parts = array( 'title' => 'The National Scream', 'site' => AD_SITE_NAME );
	} elseif ( is_singular() ) {
		$parts = array( 'title' => single_post_title( '', false ), 'site' => AD_SITE_NAME );
	} elseif ( is_search() ) {
		$parts = array( 'title' => 'Search: ' . get_search_query(), 'site' => AD_SITE_NAME );
	} elseif ( is_404() ) {
		$parts = array( 'title' => 'Page Reassigned (404)', 'site' => AD_SITE_NAME );
	} else {
		$parts['site'] = AD_SITE_NAME;
	}
	return $parts;
} );

/* ---------------------------------------------------------------------------
 * <head> meta: description, keywords, canonical, robots, OG, Twitter, favicon
 * ------------------------------------------------------------------------- */
function ad_head_meta() {
	$desc  = ad_meta_description();
	$url   = ad_canonical();
	$img   = ad_share_image();
	$theme = get_template_directory_uri();
	$type  = ( is_singular() && ! is_front_page() && ! is_page() ) ? 'article' : 'website';
	echo "\n<!-- American Dictator SEO -->\n";
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta name="keywords" content="%s">' . "\n", esc_attr( AD_KEYWORDS ) );
	printf( '<meta name="robots" content="%s">' . "\n", 'index, follow, max-image-preview:large, max-snippet:-1' );
	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );

	// Favicon / touch icon from the theme seal.
	printf( '<link rel="icon" type="image/png" href="%s">' . "\n", esc_url( $theme . '/assets/seal-192.png' ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( $theme . '/assets/seal-192.png' ) );

	// Open Graph.
	printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $type ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( AD_SITE_NAME ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( wp_get_document_title() ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $img ) );
	printf( '<meta property="og:image:width" content="%s">' . "\n", '1200' );
	printf( '<meta property="og:image:height" content="%s">' . "\n", '630' );
	printf( '<meta property="og:locale" content="%s">' . "\n", 'en_US' );

	// Twitter.
	printf( '<meta name="twitter:card" content="%s">' . "\n", 'summary_large_image' );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( wp_get_document_title() ) );
	printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $img ) );
	echo "<!-- /American Dictator SEO -->\n";
}
add_action( 'wp_head', 'ad_head_meta', 1 );

/* ---------------------------------------------------------------------------
 * JSON-LD structured data (WebSite + VideoGame + Organization)
 * ------------------------------------------------------------------------- */
function ad_schema() {
	$home  = home_url( '/' );
	$logo  = get_template_directory_uri() . '/assets/seal-512.png';
	$img   = get_template_directory_uri() . '/assets/og-image.jpg';

	$graph = array(
		array(
			'@type'       => 'Organization',
			'@id'         => $home . '#org',
			'name'        => AD_SITE_NAME,
			'url'         => $home,
			'logo'        => $logo,
		),
		array(
			'@type'           => 'WebSite',
			'@id'             => $home . '#website',
			'name'            => AD_SITE_NAME,
			'description'     => 'The satirical political survival game',
			'url'             => $home,
			'publisher'       => array( '@id' => $home . '#org' ),
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => array(
					'@type'       => 'EntryPoint',
					'urlTemplate' => $home . '?s={search_term_string}',
				),
				'query-input' => 'required name=search_term_string',
			),
		),
	);

	if ( is_front_page() ) {
		$graph[] = array(
			'@type'               => 'VideoGame',
			'@id'                 => $home . '#game',
			'name'                => 'American Dictator',
			'description'         => ad_default_description(),
			'url'                 => $home,
			'image'               => $img,
			'genre'               => array( 'Strategy', 'Political Satire', 'Simulation' ),
			'gamePlatform'        => array( 'PC', 'macOS', 'iOS', 'Android', 'Web browser' ),
			'applicationCategory' => 'GameApplication',
			'operatingSystem'     => 'Windows, macOS, iOS, Android, Web',
			'publisher'           => array( '@id' => $home . '#org' ),
			'author'              => array( '@id' => $home . '#org' ),
			'inLanguage'          => 'en',
		);
	}

	if ( is_singular( 'post' ) && ! is_front_page() ) {
		$graph[] = array(
			'@type'         => 'NewsArticle',
			'headline'      => wp_strip_all_tags( get_the_title() ),
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'author'        => array( '@type' => 'Person', 'name' => get_the_author() ),
			'publisher'     => array( '@id' => $home . '#org' ),
			'mainEntityOfPage' => get_permalink(),
			'image'         => ad_share_image(),
		);
	}

	$data = array( '@context' => 'https://schema.org', '@graph' => $graph );
	echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'ad_schema', 2 );

/* ---------------------------------------------------------------------------
 * Drop the author-archive sitemap (thin pages, minor username exposure).
 * ------------------------------------------------------------------------- */
add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	return ( 'users' === $name ) ? false : $provider;
}, 10, 2 );
