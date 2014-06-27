<?php
/** category.php
 *
 * The template for displaying Category Archive pages.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

get_header(); ?>

<section id="primary" class="span7">

	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php 
		// tha_content_top();

		if ( have_posts() ) : ?>

		<h2>Our Featured Music</h2>
		<hr />

			<?php
			while ( have_posts() ) {
				the_post();
				
				echo category_description( get_cat_ID( 'music' ) );
				if (in_category('music')) {
					get_template_part( '/partials/content', get_post_format() );
				}
			}
			the_bootstrap_content_nav();
		else :
			get_template_part( '/partials/content', 'not-found' );
		endif;
		
		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<section id="secondary" class="span5">
	
<?php if (have_posts()) :?>
	<div class="well">
	<?php while ( have_posts() ) {
				the_post();
				if (in_category('video')) {
					echo "<h3>";
					the_title();
					echo "</h3>"; ?>
					<div class="entry-content clearfix">
						<?php if ( has_post_thumbnail() ) : ?>
						<a class="thumbnail post-thumbnail span2" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a>
						<?php endif;
						the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'the-bootstrap' ) );
						the_bootstrap_link_pages(); ?>
					</div><!-- .entry-content -->
				<?php }
			} ?>
	</div>
<?php endif; ?>

<!-- print_r($wp_query); ?> -->
</section>
<?php


// get_sidebar();
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/category.php */