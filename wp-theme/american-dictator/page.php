<?php
/**
 * Generic page.
 *
 * @package American_Dictator
 */
get_header();
?>
<main class="single-article">
	<div class="single-inner">
		<a class="back-to-office" href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; Return to the Office</a>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>
<?php
get_footer();
