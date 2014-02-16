<?php
/** memberdash.php

 *

 * 

 *The template for showing a wider widget area (with forms and such).

 *


 *

 * @author		Stef Williams

 * @package		sg-bootstrap

 * @since		1.0.0 - 07.12.2012

 */

get_header(); ?>

<div id="primary" class="span9">
	<?php
//echo get_page_template();

?>
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();
		
		the_post();
		get_template_part( '/partials/content', 'page' );
		// comments_template();

		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file page.php */
/* Location: ./wp-content/themes/the-bootstrap/page.php */