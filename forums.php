<?php
/** sg-documents.php
 *
 * Template Name: Forums
 * The template for displaying all pages.
 *
 * This is the template for displaying documents, including minutes and the Sacred SG Constitution...
 *
 * @author		Stef Williams
 * @package		sg-bootstrap
 * @since		1.0.0 - 02.12.2012
 */

get_header(); 


?>
<div id="primary" class="span9">
	<div id="content" role="main">
		

		<?php do_action( 'bbp_before_main_content' ); ?>

		<?php do_action( 'bbp_template_notices' ); ?>



		<?php while ( have_posts() ) : the_post(); ?>

		<div id="forum-front" class="bbp-forum-front">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
<?php if ( is_user_logged_in() ) { ?>
				<?php the_content(); ?>

				<?php bbp_get_template_part( 'content', 'archive-forum' ); ?>
	<?php } 

else echo'You need to log in first...';
	?>
			</div>
		</div><!-- #forum-front -->

	<?php endwhile; ?>



	<?php do_action( 'bbp_after_main_content' ); ?>



	</div><!-- #content -->
</div><!-- #primary -->
<div class="span3">
<?php if ( is_user_logged_in() ) { ?>	
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('forums')) : else : ?>
	<p><strong>Widgetized Area</strong></p>
	<p>This panel is active and ready for you to add some widgets via the WP Admin</p>
<?php endif; ?>
<?php } ?>
</div>
<?php get_footer();?>