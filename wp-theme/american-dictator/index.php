<?php
/**
 * Fallback template (archives, search, and any view without a more specific
 * template). Renders the newsprint list, same as the blog index.
 *
 * @package American_Dictator
 */
get_header();
?>
<main class="paper">
	<div class="paper-inner">
		<a class="back-to-office" href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; Return to the Office</a>
		<header class="page-masthead">
			<div class="scream-title"><?php
				if ( is_search() ) {
					echo 'Search: ' . esc_html( get_search_query() );
				} elseif ( is_archive() ) {
					the_archive_title();
				} else {
					echo 'The National Scream';
				}
			?></div>
			<p class="tagline">The Paper of Record, Corrected</p>
		</header>

		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				$cats = get_the_category();
				?>
				<article class="post-item">
					<?php if ( $cats ) : ?><span class="cat"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="meta">By <?php the_author(); ?> &middot; <?php echo esc_html( get_the_date() ); ?></div>
					<div class="excerpt"><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
			<div class="pagination">
				<?php echo paginate_links( array( 'prev_text' => '&larr; Newer', 'next_text' => 'Older &rarr;' ) ); ?>
			</div>
		<?php else : ?>
			<article class="post-item">
				<h2>Nothing on file.</h2>
				<div class="excerpt">The record you seek has been reclassified, redacted, or was never permitted to exist. The Administration thanks you for your curiosity and has noted it.</div>
			</article>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
