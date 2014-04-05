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

<section id="primary" class="span9">

	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();
		if (is_category( )) {
			$cat = get_category( get_query_var( 'cat' ) );
			$cat_slug = $cat->slug;
		}
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h2 class="page-title"><?php
					echo'<span>' . single_cat_title( '', false ) . '</span>' ;
				?></h2>
	
				<?php if ( $category_description = category_description() ) {
					echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
				} ?>
			</header><!-- .page-header -->
	
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( '/partials/content', get_post_format() );
			}
			the_bootstrap_content_nav();
		else :
			get_template_part( '/partials/content', 'not-found' );
		endif;
		
		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar($cat_slug);
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/category.php */