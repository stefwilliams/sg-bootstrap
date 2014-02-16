<?php
/** single.php
 *
 * The Template for displaying all single posts.
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

		while ( have_posts() ) {
			the_post();
			get_template_part( '/partials/content', 'single' );
			comments_template();
		} ?>

		<nav id="nav-single">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'the-bootstrap' ); ?></h3>
			<ul class="pager">
				<?php
				previous_post_link( '<li class="previous">%link</li>', sprintf(
					'&larr; %1$s',
					__( 'Previous Post', 'the-bootstrap' )
				), true );
				next_post_link( '<li class="next">%link</li>', sprintf(
					'%1$s &rarr;',
					__( 'Next Post', 'the-bootstrap' )
				), true ); ?>
			</ul>
		</nav><!-- #nav-single -->

		<?php tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/single.php */