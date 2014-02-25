<?php
/** sidebar.php
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0	- 05.02.2012
 */

tha_sidebars_before(); ?>

<section id="secondary" class="widget-area span3" role="complementary">
	<?php tha_sidebar_top();
	if ( ! dynamic_sidebar( 'main' ) ) {
		$testimonials_args = array(
			'category_name' => 'testimonials',	
			'orderby' => 'rand',
			'order' => 'ASC',
			'posts_per_page'   => 1,
			);
		$testimonials_posts = new WP_Query($testimonials_args);	
		wp_reset_postdata(); ?>
<?php

		if ($testimonials_posts) { ?>
<aside id="em_widget-4" class="widget well widget_testimonial_widget"><h2 class="widget-title">The Things People Say</h2>

				<?php
				while ( $testimonials_posts->have_posts() ) {
					?>
					
						<?php 
						$testimonials_posts->the_post(); 
						get_template_part( '/partials/content', get_post_format() );
						?>
					
<?php
				// 
				} ?>
<?php
    // Get the ID of a given category
    $category_id = get_cat_ID( 'testimonials' );

    // Get the URL of this category
    $category_link = get_category_link( $category_id );
?>

<!-- Print a link to this category -->
<p style="display:block;text-align:right;">See all <a href="<?php echo esc_url( $category_link ); ?>" title="Category Name">Testimonials</a></p>

		</aside>
					<?php
		}	?>
		<aside id="testimonial_form" class="widget well widget_testimonial_form_widget">
			<h2 class="widget-title">Seen Us? Tell Us!</h2>
			<?php echo do_shortcode('[contact-form-7 id="1037" title="Seen Us? Tell Us!"]');?>
		</aside>
		<?php
		// the_widget( 'WP_Widget_Archives', array(
		// 	'count'		=>	0,
		// 	'dropdown'	=>	0
		// 	), array(
		// 	'before_widget'	=>	'<aside id="archives" class="widget well widget_archives">',
		// 	'after_widget'	=>	'</aside>',
		// 	'before_title'	=>	'<h3 class="widget-title">',
		// 	'after_title'	=>	'</h3>',
		// 	) );
		// the_widget( 'WP_Widget_Meta', array(), array(
		// 	'before_widget'	=>	'<aside id="meta" class="widget well widget_meta">',
		// 	'after_widget'	=>	'</aside>',
		// 	'before_title'	=>	'<h3 class="widget-title">',
		// 	'after_title'	=>	'</h3>',
		// 	) );
	} // end sidebar widget area
	tha_sidebar_bottom(); ?>
</section><!-- #secondary .widget-area -->
<?php tha_sidebars_after();

/* End of file sidebar.php */
/* Location: ./wp-content/themes/the-bootstrap/sidebar.php */