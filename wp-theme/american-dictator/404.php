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
		<h1>Page 404: Reassigned</h1>
		<div class="single-post-meta" style="border:none;justify-content:center;">Filed by the Ministry of Missing Things</div>
		<div class="entry-content" style="max-width:560px;margin:0 auto;">
			<p>The page you requested has been reassigned to the Freedom Ocean, along with the person who wrote it. This is not a mistake. Mistakes are not made here.</p>
			<p>You may return to the Office and pretend this never happened. We already have.</p>
			<p style="margin-top:28px;"><a class="btn btn-gold btn-big" href="<?php echo esc_url( home_url( '/' ) ); ?>">Return to the Office</a></p>
		</div>
	</div>
</main>
<?php
get_footer();
