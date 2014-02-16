<?php

/** memberdash.php

 *

 * Template Name: Member Dash

 * 

 *The template for the Member dashboard.

 *

 * This is the template that displays the SG Member dash

 *

 * @author		Stef Williams

 * @package		sg-bootstrap

 * @since		1.0.0 - 07.12.2012

 */



get_header(); ?>



<div id="primary" class="span3">

	<?php tha_content_before(); ?>

	<div id="content" role="main">
		<aside id="post-<?php the_ID(); ?>" class="widget well">
		<?php tha_content_top();
		global $current_user;
		get_currentuserinfo();
		echo "<h4>Hello $current_user->user_firstname</h4>";
		echo wpautop ($post->post_content);
//		get_template_part( '/partials/content', 'page' );
//		comments_template();
edit_post_link( __( 'Edit', 'the-bootstrap' ), '<footer class="entry-meta"><span class="edit-link label">', '</span></footer>' );		
		tha_entry_bottom();
		tha_content_bottom(); ?>
		</aside>
	</div><!-- #content -->

	<?php tha_content_after(); ?>
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('member-dash-col1')) : else : ?>

	<div class="pre-widget">

		<p><strong>Widgetized Area</strong></p>

		<p>This panel is active and ready for you to add some widgets via the WP Admin</p>

	</div>

	<?php endif; ?>

</div><!-- #primary -->

<div class="span3">

	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('member-dash-col2')) : else : ?>

	<div class="pre-widget">

		<p><strong>Widgetized Area</strong></p>

		<p>This panel is active and ready for you to add some widgets via the WP Admin</p>

	</div>

	<?php endif; ?>

</div>	

<div class="span3">

	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('member-dash-col3')) : else : ?>

	<div class="pre-widget">

		<p><strong>Widgetized Area</strong></p>

		<p>This panel is active and ready for you to add some widgets via the WP Admin</p>

	</div>

	<?php endif; ?>

</div>



<div class="span3">

	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('member-dash-col4')) : else : ?>

	<div class="pre-widget">

		<p><strong>Widgetized Area</strong></p>

		<p>This panel is active and ready for you to add some widgets via the WP Admin</p>

	</div>

	<?php endif; ?>

</div>	

<?php

get_footer();





/* End of file memberdash.php */

/* Location: ./wp-content/themes/sg-bootstrap/memberdash.php */