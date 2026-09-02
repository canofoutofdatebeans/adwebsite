<?php
/**
 * American Dictator theme functions.
 *
 * @package American_Dictator
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AD_VERSION', '1.0.0' );

/* ---------------------------------------------------------------------------
 * Theme setup
 * ------------------------------------------------------------------------- */
function ad_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );

	// WooCommerce (Phase 2: the real Patriot Store).
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'american-dictator' ) ) );
}
add_action( 'after_setup_theme', 'ad_setup' );

/* ---------------------------------------------------------------------------
 * Styles & scripts
 * ------------------------------------------------------------------------- */
function ad_assets() {
	wp_enqueue_style(
		'ad-fonts',
		'https://fonts.googleapis.com/css2?family=Anton&family=Spectral:ital,wght@0,400;0,600;1,400&family=IBM+Plex+Mono:wght@400;600&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'ad-style', get_stylesheet_uri(), array( 'ad-fonts' ), AD_VERSION );
	wp_enqueue_script( 'ad-site', get_template_directory_uri() . '/js/site.js', array(), AD_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'ad_assets' );

/* ---------------------------------------------------------------------------
 * Small helpers for editable content (Customizer theme mods)
 * ------------------------------------------------------------------------- */
function ad_mod( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

/** An image theme-mod with a bundled asset as the fallback. */
function ad_img( $key, $default_file ) {
	$v = get_theme_mod( $key );
	return $v ? esc_url( $v ) : esc_url( get_template_directory_uri() . '/assets/' . $default_file );
}

/** URL of the blog (National Scream) index, wherever the user set it. */
function ad_blog_url() {
	$pid = (int) get_option( 'page_for_posts' );
	return $pid ? get_permalink( $pid ) : home_url( '/' );
}

/** Turn a newline-separated textarea into an array of trimmed lines. */
function ad_lines( $key, $default_lines = array() ) {
	$raw = get_theme_mod( $key );
	if ( ! $raw ) {
		return $default_lines;
	}
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $raw ) ) ) );
}

/* ---------------------------------------------------------------------------
 * The Customizer: what the President is allowed to edit
 * ------------------------------------------------------------------------- */
function ad_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'ad_content', array(
		'title'    => __( 'American Dictator Content', 'american-dictator' ),
		'priority' => 20,
	) );

	// Text field factory.
	$text = function ( $id, $label, $section, $default = '', $type = 'text' ) use ( $wp_customize ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $default,
			'sanitize_callback' => ( 'textarea' === $type ) ? 'wp_kses_post' : 'sanitize_text_field',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $label,
			'section' => $section,
			'type'    => $type,
		) );
	};
	$image = function ( $id, $label, $section ) use ( $wp_customize ) {
		$wp_customize->add_setting( $id, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
			'label'   => $label,
			'section' => $section,
		) ) );
	};

	/* Hero */
	$wp_customize->add_section( 'ad_hero', array( 'title' => 'Hero', 'panel' => 'ad_content' ) );
	$text( 'ad_hero_kicker', 'Kicker', 'ad_hero', 'The Patriot Party presents' );
	$text( 'ad_hero_title1', 'Title line 1', 'ad_hero', 'AMERICAN' );
	$text( 'ad_hero_title2', 'Title line 2', 'ad_hero', 'DICTATOR' );
	$text( 'ad_hero_tagline', 'Tagline (HTML allowed)', 'ad_hero', 'One term. One chance. <b>Zero term limits.</b>', 'textarea' );
	$text( 'ad_hero_sub', 'Sub-paragraph', 'ad_hero', 'A satirical political survival game. A crisis lands on your desk every month. You get three bad options, one worse one, and a timer. Capture the courts, the Congress, and the press before the republic notices, or lose the only election you ever intend to hold.', 'textarea' );
	$image( 'ad_hero_image', 'Hero background image', 'ad_hero' );

	/* Primary call to action (the Steam link when it exists) */
	$wp_customize->add_section( 'ad_cta', array( 'title' => 'Main Button / Steam link', 'panel' => 'ad_content' ) );
	$text( 'ad_cta_label', 'Button label', 'ad_cta', 'Coming soon. Prepare accordingly.' );
	$text( 'ad_cta_url', 'Button link (e.g. your Steam page)', 'ad_cta', '#download' );

	/* Ticker */
	$wp_customize->add_section( 'ad_ticker', array( 'title' => 'News Ticker', 'panel' => 'ad_content' ) );
	$text( 'ad_ticker_lines', 'Headlines (one per line)', 'ad_ticker', '', 'textarea' );

	/* President's letter */
	$wp_customize->add_section( 'ad_letter', array( 'title' => "President's Message", 'panel' => 'ad_content' ) );
	$text( 'ad_letter_heading', 'Heading (HTML allowed)', 'ad_letter', "\"It's good to be<br>the President.\"", 'textarea' );
	$text( 'ad_letter_body', 'Letter body (HTML allowed)', 'ad_letter', '', 'textarea' );
	$text( 'ad_portrait_caption', 'Portrait caption', 'ad_letter', "The official state portrait, painted from the President's best angle." );
	$image( 'ad_portrait_male', 'Portrait A', 'ad_letter' );
	$image( 'ad_portrait_female', 'Portrait B', 'ad_letter' );
}
add_action( 'customize_register', 'ad_customize_register' );

/* ---------------------------------------------------------------------------
 * WooCommerce: wrap shop pages in the theme's container + styling hooks
 * ------------------------------------------------------------------------- */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function ad_woo_wrapper_start() {
	echo '<div class="woocommerce-store"><div class="woo-inner"><a class="back-to-office" href="' . esc_url( home_url( '/' ) ) . '">&larr; Return to the Office</a>';
}
add_action( 'woocommerce_before_main_content', 'ad_woo_wrapper_start', 10 );

function ad_woo_wrapper_end() {
	echo '</div></div>';
}
add_action( 'woocommerce_after_main_content', 'ad_woo_wrapper_end', 10 );

/** Excerpt tweaks for the newsprint cards. */
function ad_excerpt_length() {
	return 26;
}
add_filter( 'excerpt_length', 'ad_excerpt_length' );

function ad_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'ad_excerpt_more' );
