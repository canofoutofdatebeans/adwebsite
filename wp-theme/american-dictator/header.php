<?php
/**
 * Header: official banner + navigation.
 *
 * @package American_Dictator
 */
$ad_store_url = ad_store_url();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Official-website banner -->
<div class="gov-banner" role="note">
	<span class="gov-flag" aria-hidden="true"></span>
	<span>An official website of the Patriot Party.</span>
	<button class="gov-how" id="govHow" type="button">Here's how you know</button>
	<span class="gov-answer" id="govAnswer" hidden>You know because we are telling you, and we have never been wrong. See headline, below, about how we have never been wrong.</span>
</div>

<!-- Navigation -->
<header class="nav" id="nav">
	<a class="nav-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img src="<?php echo ad_img( 'ad_seal', 'seal-192.png' ); ?>" alt="The Seal of the President" width="40" height="40" id="sealBtn">
		<span class="nav-title">American <em>Dictator</em></span>
	</a>
	<nav class="nav-links" aria-label="Main">
		<a href="<?php echo esc_url( home_url( '/#mandate' ) ); ?>">The Mandate</a>
		<a href="<?php echo esc_url( home_url( '/#machinery' ) ); ?>">The Machinery</a>
		<a href="<?php echo esc_url( ad_blog_url() ); ?>">The National Scream</a>
		<a href="<?php echo esc_url( $ad_store_url ); ?>">Patriot Store</a>
		<a href="<?php echo esc_url( home_url( '/#download' ) ); ?>">Download</a>
	</nav>
	<div class="nav-right">
		<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
			<a class="nav-cart" id="cartBadge" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="The Tribute Register">🦅 Tributes: <b id="cartCount"><?php echo function_exists( 'WC' ) && WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?></b></a>
		<?php else : ?>
			<span class="nav-cart" id="cartBadge" title="The Tribute Register">🦅 Tributes: <b id="cartCount">0</b></span>
		<?php endif; ?>
		<a class="btn btn-gold btn-small" href="<?php echo esc_url( home_url( '/#download' ) ); ?>">Seize Power</a>
	</div>
</header>
