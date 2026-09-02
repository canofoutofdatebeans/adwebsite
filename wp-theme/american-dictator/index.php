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
		<a class="back-to-office" href="<?php echo esc_url( ad_localize_url( home_url( '/' ) ) ); ?>">&larr; <?php echo esc_html( ad_t( 'blog.back' ) ); ?></a>
		<header class="page-masthead">
			<div class="scream-title"><?php
				if ( is_search() ) {
					echo esc_html( ad_t( 'search.prefix' ) ) . ' ' . esc_html( get_search_query() );
				} elseif ( is_archive() ) {
					the_archive_title();
				} else {
					echo esc_html( ad_t( 'scream.h' ) );
				}
			?></div>
			<p class="tagline"><?php echo esc_html( ad_t( 'scream.rule' ) ); ?></p>
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
				<h2><?php echo esc_html( ad_t( 'archive.empty.h' ) ); ?></h2>
				<div class="excerpt"><?php echo esc_html( ad_t( 'archive.empty.p' ) ); ?></div>
			</article>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
