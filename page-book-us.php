<?php
/** page.php
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>

<div id="primary" class="span8">
	<?php
//echo get_page_template();

?>
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();
		
		the_post();
		get_template_part( '/partials/content', 'page' );
		comments_template();

		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</div><!-- #primary -->
<section id="secondary" class="span4" role="complementary">
	<?php echo do_shortcode('[contact-form-7 id="608" title="Book the Band"]'); ?>
</section>

<?php
get_sidebar();
get_footer();


/* End of file page.php */
/* Location: ./wp-content/themes/the-bootstrap/page.php */