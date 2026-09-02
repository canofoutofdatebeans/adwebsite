<?php
/**
 * Header: official banner, navigation, language switcher.
 *
 * @package American_Dictator
 */
$ad_store_url = ad_store_url();
$ad_langs     = ad_languages();
$ad_cur       = ad_lang();
?><!DOCTYPE html>
<html lang="<?php echo esc_attr( $ad_langs[ $ad_cur ]['hreflang'] ); ?>">
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
	<span><?php echo esc_html( ad_t( 'gov.banner' ) ); ?></span>
	<button class="gov-how" id="govHow" type="button"><?php echo esc_html( ad_t( 'gov.how' ) ); ?></button>
	<span class="gov-answer" id="govAnswer" hidden><?php echo esc_html( ad_t( 'gov.answer' ) ); ?></span>
</div>

<!-- Navigation -->
<header class="nav" id="nav">
	<a class="nav-brand" href="<?php echo esc_url( ad_localize_url( home_url( '/' ) ) ); ?>">
		<img src="<?php echo ad_img( 'ad_seal', 'seal-192.png' ); ?>" alt="American Dictator" width="40" height="40" id="sealBtn">
		<span class="nav-title">American <em>Dictator</em></span>
	</a>
	<nav class="nav-links" aria-label="Main">
		<a href="<?php echo esc_url( ad_localize_url( home_url( '/#mandate' ) ) ); ?>"><?php echo esc_html( ad_t( 'nav.mandate' ) ); ?></a>
		<a href="<?php echo esc_url( ad_localize_url( home_url( '/#machinery' ) ) ); ?>"><?php echo esc_html( ad_t( 'nav.machinery' ) ); ?></a>
		<a href="<?php echo esc_url( ad_localize_url( ad_blog_url() ) ); ?>"><?php echo esc_html( ad_t( 'nav.scream' ) ); ?></a>
		<a href="<?php echo esc_url( ad_localize_url( $ad_store_url ) ); ?>"><?php echo esc_html( ad_t( 'nav.store' ) ); ?></a>
		<a href="<?php echo esc_url( ad_localize_url( home_url( '/#download' ) ) ); ?>"><?php echo esc_html( ad_t( 'nav.download' ) ); ?></a>
	</nav>
	<div class="nav-right">
		<details class="lang-switch" id="langSwitch">
			<summary aria-label="<?php echo esc_attr( ad_t( 'lang.label' ) ); ?>"><span class="lang-flag"><?php echo esc_html( $ad_langs[ $ad_cur ]['flag'] ); ?></span><span class="lang-name"><?php echo esc_html( $ad_langs[ $ad_cur ]['native'] ); ?></span><span class="lang-caret" aria-hidden="true">▾</span></summary>
			<div class="lang-menu">
				<?php foreach ( $ad_langs as $code => $meta ) : ?>
					<a class="lang-opt<?php echo $code === $ad_cur ? ' is-active' : ''; ?>" href="<?php echo esc_url( ad_url_in_lang( $code ) ); ?>" hreflang="<?php echo esc_attr( $meta['hreflang'] ); ?>" lang="<?php echo esc_attr( $meta['hreflang'] ); ?>"><span class="lang-flag"><?php echo esc_html( $meta['flag'] ); ?></span><?php echo esc_html( $meta['native'] ); ?></a>
				<?php endforeach; ?>
			</div>
		</details>
		<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
			<a class="nav-cart" id="cartBadge" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="The Tribute Register">🦅 <?php echo esc_html( ad_t( 'nav.tributes' ) ); ?> <b id="cartCount"><?php echo function_exists( 'WC' ) && WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?></b></a>
		<?php else : ?>
			<span class="nav-cart" id="cartBadge" title="The Tribute Register">🦅 <?php echo esc_html( ad_t( 'nav.tributes' ) ); ?> <b id="cartCount">0</b></span>
		<?php endif; ?>
		<a class="btn btn-gold btn-small" href="<?php echo esc_url( ad_localize_url( home_url( '/#download' ) ) ); ?>"><?php echo esc_html( ad_t( 'nav.seize' ) ); ?></a>
	</div>
</header>
