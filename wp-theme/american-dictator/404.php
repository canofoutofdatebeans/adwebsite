<?php
/**
 * 404: a page that has been disappeared.
 *
 * @package American_Dictator
 */
get_header();
?>
<main class="single-article">
	<div class="single-inner" style="text-align:center;">
		<h1><?php echo esc_html( ad_t( 'e404.h' ) ); ?></h1>
		<div class="single-post-meta" style="border:none;justify-content:center;"><?php echo esc_html( ad_t( 'e404.meta' ) ); ?></div>
		<div class="entry-content" style="max-width:560px;margin:0 auto;">
			<p><?php echo esc_html( ad_t( 'e404.p1' ) ); ?></p>
			<p><?php echo esc_html( ad_t( 'e404.p2' ) ); ?></p>
			<p style="margin-top:28px;"><a class="btn btn-gold btn-big" href="<?php echo esc_url( ad_localize_url( home_url( '/' ) ) ); ?>"><?php echo esc_html( ad_t( 'e404.btn' ) ); ?></a></p>
		</div>
	</div>
</main>
<?php
get_footer();
