<?php
/** index.php
 *
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

get_header(); 
if (function_exists('wpmd_is_notphone')) {
	$notphone = wpmd_is_notphone();
}
// var_dump($notphone);
$public_events = get_term_by('slug', 'public-events', 'event-categories');
$public_events_id = $public_events->term_id;
$cat_args = array(
	'taxonomy' => 'event-categories',
	'parent' => $public_events_id,
	);

$public_categories = get_categories($cat_args);
$cats = array();
foreach ($public_categories as $category) {
	array_push($cats, $category->term_id);
}
$cats = implode(",", $cats);
$EM_Events = EM_Events::get( array(
	'scope'=>'future', 
	'orderby'=>'event_start_date', 
	'limit'=>7, //7 max unless carousel is redesigned
	'category' => $cats,
	) );
	?>
	<section id="primary" class="span12">
		<?php	

		$total = count($EM_Events);	
		if ($EM_Events && $total > 1) { ?>
		<h3>Upcoming Events</h3>
		<?php }
		else { ?>
		<h3>Upcoming Event</h3>
		<?php } ?>
		<script>
		jQuery(function () {
			jQuery(".carousel").carousel({ interval: false });
		});
		</script>
		<div class="row">
			<div class="span9">
							<ol class="carousel-indicators visible-phone">
								<?php
								foreach ($EM_Events as $EM_Event) {
									$att_id = get_post_thumbnail_id($EM_Event->post_id );
									if ($att_id) {
										$img_src = wp_get_attachment_image_src( $att_id, 'thumbnail');
									}
									// img_src[3] returns true if the requested image size is found...
									if ($att_id && ($img_src[3] == 1)) {
										$img_src = $img_src[0];
									}
									else {
										$img_src = site_url().'/wp-content/uploads/carousel_default-150x150.jpg';
									}
									
									// print_r();
										echo '<li class="span1"><img src="'.$img_src.'" /><div class="event_details"><h4>'.$EM_Event->output("#_EVENTLINK").'</h4><p class="date">'.$EM_Event->output('#l').'&nbsp'.$EM_Event->output('#F').'&nbsp'.$EM_Event->output('#j').'</p>
										<p>'.$EM_Event->output('#_EVENTTIMES').'</p><p>'.$EM_Event->output('#_LOCATIONNAME').', '.$EM_Event->output('#_LOCATIONTOWN').'</p></div></li>';
									}
								?>
							</ol>

				<?php	
				if ($EM_Events && $notphone) {
					?>
					<div id="eventCarousel" class="carousel slide well hidden-phone">
						<div class="carousel-inner">
							<?php
							$current = 0;
							foreach ($EM_Events as $EM_Event) {
								$att_id = get_post_thumbnail_id($EM_Event->post_id );
								if ($att_id) {
									$img_src = wp_get_attachment_image_src( $att_id, 'carousel');		
								}

								if ($att_id && ($img_src[3] == 1)) {	
									$img_src = $img_src[0];
								}
								else {
									$img_src = site_url().'/wp-content/uploads/carousel_default.jpg';
								}
								if ($current === 0) {
									$active = ' active';
								}
								else {
									$active = '';
								}
								echo '<div class="item'.$active.'" id="'.$current.'">';
								echo '<h4 class="hidden-phone">'.$EM_Event->output("#_EVENTLINK").'</h4>';



								echo '<a href="'.$EM_Event->output('#_EVENTURL').'"><img class="hidden-phone" src="'.$img_src.'" /></a>';
								?>

								<div class="event-details hidden-phone">
									<?php echo '<p class="event_cat">'.$EM_Event->output('#_CATEGORYNAME').':</p>'; ?>
									<?php echo '<p>'.$EM_Event->output('#l').'&nbsp'.$EM_Event->output('#F').'&nbsp'.$EM_Event->output('#j').'</p>'; ?>
									<?php echo '<p>'.$EM_Event->output('#_EVENTTIMES').'</p>'; ?>
									<?php echo '<p>'.$EM_Event->output('#_LOCATIONNAME').'</p>'; ?>
								</div>



								<?php
// 'size_exists='.$img_src[3].
								echo '</div>';
								$current += 1;
							}
							?>
								<?php 
								if ($total > 1) {
									?>

							<ol class="carousel-indicators">
								<?php


								$count = 0;
								foreach ($EM_Events as $EM_Event) {
									$att_id = get_post_thumbnail_id($EM_Event->post_id );
									if ($att_id) {
										$img_src = wp_get_attachment_image_src( $att_id, 'thumbnail');
									}
									if ($att_id && ($img_src[3] == 1)) {
										$img_src = $img_src[0];
									}
									else {
										$img_src = site_url().'/wp-content/uploads/carousel_default-150x150.jpg';
									}
									
									if ( $count < $total) {
										if ($count === 0) {
											$active = ' class="span1 active"';
										}
										else {
											$active = ' class="span1"';
										}

									// print_r();
										echo '<li data-target="#eventCarousel" data-slide-to="'.$count.'"'.$active.'><img src="'.$img_src.'" /><span>'.$EM_Event->output('#d').' / '.$EM_Event->output('#m').'</span></li>';
										$count += 1;
									}
								}

								?>
							</ol>
															<?php
								}
								?>						
						</div>

			<!-- 			<a class="carousel-control left" href="#eventCarousel" data-slide="prev">&lsaquo;</a>
						<a class="carousel-control right" href="#eventCarousel" data-slide="next">&rsaquo;</a> -->
					</div>
									<?php
				}
				?>
			</div>
			<div class="span3">
				<aside id="book_us" class="widget widget_text">
					<img src=<?php echo get_stylesheet_directory_uri()."/css/book_img.jpg"; ?> class="hidden-tablet"/>
					<div class="textwidget"><p>Gigs, parades, team-building workshops. You name it, we can do it.</p><p>Get in touch to discuss how we can liven up your event.</p><p> </p><p><a class="btn btn-block btn-success btn-large" href="book-us">Book the Band</a></p></div>
				</aside>
				<aside id="join_us" class="widget widget_text">
					<img src=<?php echo get_stylesheet_directory_uri()."/css/join_img.jpg"; ?> class="hidden-tablet" />
					<div class="textwidget"><p>Samba Gal&ecirc;z is open to anyone to join, either as a dancer or a drummer.</p><p>All we ask is that you do a short introductory course.</p><p> <a class="btn btn-block btn-info btn-large" href="join-us">Join the Band</a></p></div>
				</aside>
			</div>
		</div>

	</section>

	<section id="primary" class="span9">
		<?php tha_content_before(); ?>
		<div id="content" role="main">
			<?php tha_content_top();

			$home_args = array(
				'category_name' => 'homepage',	
				'orderby' => 'date',
				'order' => 'DESC',
				);
			$home_posts = new WP_Query($home_args);
			wp_reset_postdata();

			$testimonials_args = array(
				'category_name' => 'testimonials',	
				'orderby' => 'rand',
				'order' => 'ASC',
				'posts_per_page'   => 3,
				);
			$testimonials_posts = new WP_Query($testimonials_args);	
			wp_reset_postdata();
		// echo "<pre>";
		// print_r($home_posts);
		// echo "</pre>";


// print_r($event_posts);



			if ( $home_posts->have_posts() ) {
				echo "<h3>News</h3>";
				while ( $home_posts->have_posts() ) {
					$home_posts->the_post();
					get_template_part( '/partials/content', get_post_format() );			
				}
			}

			if (($testimonials_posts) && !($home_posts->have_posts())) {
				echo "<h3>The Things People Say...</h3>"; ?>
				<div class="row">
					<?php
					while ( $testimonials_posts->have_posts() ) {
						?>
						<div class="span3">
							<?php 
							$testimonials_posts->the_post(); 
							get_template_part( '/partials/content', get_post_format() );
							?>
						</div>
						<?php
				// 
					} ?>
				</div>
				<?php
			}		


			tha_content_bottom(); ?>
		</div><!-- #content -->
		<?php tha_content_after(); ?>
	</section><!-- #primary -->

	<div class="span3">

		<?php
		$home = get_category_by_slug('homepage');
		$home_id = $home->term_id;
		$news_args = array(
			'category_name' => 'news',
			'category__not_in' => $home_id,
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 5,
			);
		$news_posts = new WP_Query($news_args);
		wp_reset_postdata(); ?>

		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-col1')) : else : ?>
<!-- 
		<div class="pre-widget">

			<p><strong>Widgetized Area</strong></p>

			<p>This panel is active and ready for you to add some widgets via the WP Admin</p>

		</div>
	-->
<?php endif; ?>


<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-col2')) : else : ?>
<!-- 
	<div class="pre-widget">

		<p><strong>Widgetized Area</strong></p>

		<p>This panel is active and ready for you to add some widgets via the WP Admin</p>
	</div> -->

<?php endif; ?>
<?php

if ($news_posts->have_posts()) { ?>
<aside id="prev_news" class="widget widget_news_widget"><h2 class="widget-title">Band News</h2>

	<ul>
		<?php	
		while ( $news_posts->have_posts() ) {
			$news_posts->the_post(); ?>
			<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</li>
			<?php
		}
		?>
	</ul>

</aside>	
<?php }
?>
</div>	

<?php
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/index.php */