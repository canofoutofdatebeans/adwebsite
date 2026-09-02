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
		<p class="footer-motto">E PLURIBUS ME</p>
		<p class="footer-satire"><b>American Dictator is a work of satire.</b> Every person, party, agency, court, company, and
		country in the game and on this website is fictional. No real person is depicted, named, or endorsed, and no real
		products are for sale, especially the pardon.</p>
		<p class="footer-lines">Paid for by the Committee to Re-Elect the President, Forever. &middot; Not paid for, actually. &middot;
		This website collects no data. It simply assumes.</p>
		<nav class="footer-nav" aria-label="Footer">
			<a href="<?php echo esc_url( home_url( '/#download' ) ); ?>">The game, coming soon</a>
			<a href="<?php echo esc_url( ad_blog_url() ); ?>">The National Scream</a>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>#top">Return to the top, by order of the top</a>
		</nav>
		<p class="footer-copy">&copy; <span id="year"><?php echo esc_html( date( 'Y' ) ); ?></span> American Dictator. All rights reserved, then expanded.</p>
	</div>
</footer>

<div class="toast" id="toast" role="status" aria-live="polite"></div>

<?php wp_footer(); ?>
</body>
</html>
