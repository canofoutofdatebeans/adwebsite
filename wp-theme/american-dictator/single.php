<?php
/**
 * Single post: a Scream dispatch.
 *
 * @package American_Dictator
 */
get_header();
?>
<main class="single-article">
	<div class="single-inner">
		<a class="back-to-office" href="<?php echo esc_url( ad_blog_url() ); ?>">&larr; Back to The National Scream</a>
		<?php
		while ( have_posts() ) :
			the_post();
			$cats = get_the_category();
			?>
			<article <?php post_class(); ?>>
				<?php if ( $cats ) : ?><span class="cat" style="font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:var(--red);"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
				<h1><?php the_title(); ?></h1>
				<div class="single-post-meta">By <?php the_author(); ?> &middot; <?php echo esc_html( get_the_date() ); ?><?php echo get_the_category_list() ? ' &middot; Filed under ' . get_the_category_list( ', ' ) : ''; ?></div>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumb" style="margin-bottom:28px;"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
