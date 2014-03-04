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
			<?php 

			$bandnews_args = array(
	'category_name' => 'band-news',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 1,
	);
$bandnews_posts = new WP_Query($bandnews_args);
?>

<h4>Latest Band News</h4>
					<div class="">
<?php
while ( $bandnews_posts->have_posts() ) {
					$bandnews_posts->the_post(); 
					?>
					<?php
					echo "<h5><strong>".get_the_title()."</strong></h5>";
					the_content();	
					echo "<p>by: ".get_the_author()."</p>";
				}

// 			tha_content_top();
// 			global $current_user;
// 			get_currentuserinfo();
// 			echo "<h4>Hello $current_user->user_firstname</h4>";
// 			echo wpautop ($post->post_content);
// //		get_template_part( '/partials/content', 'page' );
// //		comments_template();
// 			edit_post_link( __( 'Edit', 'the-bootstrap' ), '<footer class="entry-meta"><span class="edit-link label">', '</span></footer>' );		
// 			tha_entry_bottom();
// 			tha_content_bottom();
			 ?>
			<?php
			if ($bandnews_posts->found_posts > 1) {
				$category_id = get_cat_ID( 'Band News' );
				$category_link = get_category_link( $category_id );
				echo "<a href='".esc_url( $category_link )."'>See all Band News posts</a>";
			}
			?>

			</div>
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
<?php

$user_id = get_current_user_id();
$role = get_user_role ($user_id);
$admin_tag = get_term_by('slug', 'samba_admin', 'post_tag');
$editor_tag = get_term_by('slug', 'samba_editor', 'post_tag');

		// print_r($admin_tag->term_id);

if ($role == "samba_editor") {
	$ignore_tags = array( 
		$admin_tag->term_id
		);
}
elseif ($role == "samba_player") {
	$ignore_tags = array( 
		$admin_tag->term_id,
		$editor_tag->term_id,
		);
}
else {
	$ignore_tags = array();
}




$webhelp_args = array(
	'category_name' => 'web-help',
	'orderby' => 'date',
	'order' => 'DESC',
	'tag__not_in' => $ignore_tags,
	'posts_per_page' => 5
	);
$webhelp_posts = new WP_Query($webhelp_args);
if ($webhelp_posts->have_posts()) {
				$category_id = get_cat_ID( 'Web Help' );
				$category_link = get_category_link( $category_id );
	?>
	<aside id="text-4" class="widget well widget_text">

		<h2 class="widget-title"><a href="<?php echo esc_url( $category_link ); ?>">Web Help</a></h2>			
		<div class="web-help-list">
			<ul class="unstyled">
				<?php
				while ( $webhelp_posts->have_posts() ) {
					$webhelp_posts->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
					<?php	
				}
				?>
			</ul>
			<?php
			if ($webhelp_posts->found_posts > 5) {
				$category_id = get_cat_ID( 'Web Help' );
				$category_link = get_category_link( $category_id );
				echo "<a href='".esc_url( $category_link )."'>See all web-help posts</a>";
			}
			?>
		</div>

	</aside>		
	<?php
}
?>


</div>	

<?php

get_footer();





/* End of file memberdash.php */

/* Location: ./wp-content/themes/sg-bootstrap/memberdash.php */