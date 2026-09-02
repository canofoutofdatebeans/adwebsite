<?php
/**
 * Footer.
 *
 * @package American_Dictator
 */
?>
<footer class="footer">
	<div class="wrap">
		<div class="footer-seal"><img src="<?php echo ad_img( 'ad_seal', 'seal-192.png' ); ?>" alt="" width="72" height="72"></div>
		<p class="footer-motto"><?php echo esc_html( ad_t( 'foot.motto' ) ); ?></p>
		<p class="footer-satire"><?php echo wp_kses_post( ad_t( 'foot.satire' ) ); ?></p>
		<p class="footer-lines"><?php echo wp_kses_post( ad_t( 'foot.lines' ) ); ?></p>
		<nav class="footer-nav" aria-label="Footer">
			<a href="<?php echo esc_url( ad_localize_url( home_url( '/#download' ) ) ); ?>"><?php echo esc_html( ad_t( 'foot.game' ) ); ?></a>
			<a href="<?php echo esc_url( ad_localize_url( ad_blog_url() ) ); ?>"><?php echo esc_html( ad_t( 'foot.scream' ) ); ?></a>
			<a href="<?php echo esc_url( ad_localize_url( home_url( '/' ) ) ); ?>#top"><?php echo esc_html( ad_t( 'foot.top' ) ); ?></a>
		</nav>
		<p class="footer-copy">&copy; <span id="year"><?php echo esc_html( date( 'Y' ) ); ?></span> <?php echo esc_html( ad_t( 'foot.copy' ) ); ?></p>
	</div>
</footer>

<div class="toast" id="toast" role="status" aria-live="polite"></div>

<?php wp_footer(); ?>
</body>
</html>
