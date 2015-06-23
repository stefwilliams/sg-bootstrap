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



?>
<section class="span3 widgetarea">

	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-col1')) : else : ?>

	<div class="pre-widget">

		<p><strong>Widgetized Area</strong></p>

		<p>This panel is active and ready for you to add some widgets via the WP Admin</p>

	</div>

<?php endif; ?>
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
wp_reset_postdata();

if ($news_posts->have_posts()) { ?>
<aside id="prev_news" class="widget well widget_news_widget"><h2 class="widget-title">Old News</h2>
	
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
<?php
}


?>


</section>
<section id="primary" class="span6">
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
			'posts_per_page'   => 2,
			);
		$testimonials_posts = new WP_Query($testimonials_args);	
		wp_reset_postdata();
		// print_r($testimonials_posts);


// print_r($event_posts);


		
		if ( $home_posts->have_posts() ) {
			echo "<h3>News</h3>";
			while ( $home_posts->have_posts() ) {
				$home_posts->the_post();
				get_template_part( '/partials/content', get_post_format() );			
			}
		}
		$public_events = get_term_by('slug', 'public-events', 'event-categories');
		$public_events_id = $public_events->term_id;
// error_log(print_r($public_events, true));

$cat_args = array(
	'taxonomy' => 'event-categories',
	'parent' => $public_events_id,
	);

$public_categories = get_categories($cat_args);
$cats = array();
foreach ($public_categories as $category) {
	array_push($cats, $category->term_id);
	# code...
}
// $cats = "'".$cats."'";
$cats = implode(",", $cats);
// $dump = var_export($public_categories);
// error_log(print_r($public_categories, true));
		// $gigs = get_term_by('slug', 'gig', 'event-categories');
		// $gig_id = $gigs->term_id;
		// $carnival = get_term_by('slug', 'carnival', 'event-categories');
		// $carnival_id = $carnival->term_id;
		// $parade = get_term_by('slug', 'parade', 'event-categories');
		// $parade_id = $parade->term_id;
		// $festival = get_term_by('slug', 'festival', 'event-categories');
		// $festival_id = $festival->term_id;
		// $public_workshop = get_term_by('slug', 'public-workshop', 'event-categories');
		// $public_workshop_id = $public_workshop->term_id;
		// $access = get_term_by('slug', 'access-course', 'event-categories');
		// $access_id = $access->term_id;
		// $dance = get_term_by('slug', 'dance-course', 'event-categories');
		// $dance_id = $dance->term_id;				

		$EM_Events = EM_Events::get( array(
			'scope'=>'future', 
			'orderby'=>'event_start_date', 
			// 'order'=> 'DESC',
			'limit'=>1,
			'category' => $cats,
			// 'category' => $gig_id, $access_id, $dance_id, $carnival_id, $parade_id, $festival_id, $public_workshop_id,
			) );
// error_log(print_r($EM_Events, true));
		if ($EM_Events) {


			foreach ($EM_Events as $EM_Event) { 
				echo '<header class="page-header" style="margin-top:0;">';
				echo "<h3 style='display:inline-block;'>Next ".$EM_Event->output("#_CATEGORYNAME").": </h3>";
				?>
				
				
				<?php
				echo '<h4 class="entry-title" style="display:inline-block">&nbsp; '.$EM_Event->output("#_EVENTLINK").'</h4></header><article class="post">';
				if ($EM_Event->output("#_EVENTIMAGEURL")) {	

					echo '<img class="thumbnail aligncenter" src="'.$EM_Event->output("#_EVENTIMAGEURL").'" />'; 
				}?>
				<div class="span2 pull-right alert alert-info">
					<label>Date</label>
					<p><?php echo $EM_Event->output('#_EVENTDATES'); ?></p>
					<label>Time</label>
					<p><em><?php echo $EM_Event->output('#_EVENTTIMES'); ?></em></p>
					<label>Location</label>
					<p><?php echo $EM_Event->output('#_LOCATIONLINK'); ?></p>
				</div>
				<?	
				echo '<p>'.$EM_Event->output("#_EVENTNOTES").'</p>';
				echo "</article>";
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

	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-col2')) : else : ?>

	<div class="pre-widget">

		<p><strong>Widgetized Area</strong></p>

		<p>This panel is active and ready for you to add some widgets via the WP Admin</p>
	</div>

<?php endif; ?>
</div>	

<?php
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/index.php */