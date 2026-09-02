<?php
/**
 * Blog index: The National Scream.
 *
 * @package American_Dictator
 */
get_header();
?>
<main class="paper">
	<div class="paper-inner">
		<a class="back-to-office" href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; Return to the Office</a>
		<header class="page-masthead">
			<div class="scream-title">The National Scream</div>
			<p class="tagline">The Paper of Record, Corrected &middot; Est. Whenever</p>
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
				<h2>No news is good news.</h2>
				<div class="excerpt">The Scream has nothing to report, which the Administration considers its finest edition yet.</div>
			</article>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
