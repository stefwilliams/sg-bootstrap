<?php
/*
Template Name: Encontro Leaders Page
*/

/** leaders.php

 *

 * The template for displaying Workshop leaders.

 *

 * @author		Stef

 * @package		sg-bootstrap

 * @since		1.0.0 - 05.02.2012

 */




get_header(); ?>


<?php 
get_template_part( 'encontro/nav' );
?>

<section id="primary" class="encontro span9">

	<h3 id="post-title"><?php echo $post->post_title; ?></h3>

	<?php tha_content_before(); ?>

	<div id="content" role="main">

	<?php 
	if ($post->post_content != "") {
	echo $post->post_content;
	echo "<hr />";
	}

	?>

	<?php

	$args = array (

		'category_name' => 'leaders',

		'post_status' => array(                 
            'publish',
            ),
		);


		$leaders = new WP_Query ($args);
// echo "<pre>";
// print_r($leaders);
// echo "</pre>";
// var_dump($leaders);
		// tha_content_top();

		if ( $leaders->have_posts() ) : ?>

		<div class="row">


			<?php

			while ( $leaders->have_posts() ) {

				$leaders->the_post();
$current_post = $leaders->current_post + 1;
				$post_pic = get_the_post_thumbnail($post->ID, array(250,250), array('class'=> "img-rounded", 'alt' => trim( strip_tags( $post->post_excerpt ) ), 'title'	=> trim( strip_tags( $post->post_title ) ),));



				echo '<div class="span3">';
					echo '<div class="well well-small leaders">';
						echo "<div class='span1 pull-right'><a href='#modal".$post->ID."' data-toggle='modal'>".$post_pic."</a></div>";
						echo "<a href='#modal".$post->ID."' data-toggle='modal'><h4>".$post->post_title."</h4></a>";
						echo "<p>".$post->post_excerpt."</p>";
						// $posttags = get_the_tags( );
						// if ($posttags) {
						// 	// echo "<p>";
						//   foreach($posttags as $tag) {
						//   	// print_r($tag);
						//     echo "<span class='label label-info'>".$tag->name ."</span>"; 
						//   }
						//   echo "<div class='clearfix'>&nbsp;</div>";
						//   // echo "</p>";
						// }

						// print_r($posttags);
					echo '</div>';
				echo '</div>';

if ($current_post % 3 == 0) { //prevents problems at responsive break-points
	echo "</div><div class='row'>";
}

				echo '<div id="modal'.$post->ID.'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';?>
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					    <h3 id="myModalLabel"><?php echo $post->post_title; ?></h3>
					  </div>
					  <div class="modal-body">
					   <?php get_template_part( 'encontro/content' );
					get_template_part( 'encontro/leaderworkshops' );?>
					  </div>
					  <div class="modal-footer">
					    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					  </div>

<?php
				echo '</div>';
				

			}

			the_bootstrap_content_nav();

		else :

			get_template_part( '/partials/content', 'not-found' ); ?>


		</div> <!--end row-->
<?php

		endif;
wp_reset_postdata();
		

		tha_content_bottom(); ?>

	</div><!-- #content -->

	<?php tha_content_after(); ?>

</section><!-- #primary -->



<?php





// get_sidebar();

get_footer();





/* End of file index.php */

/* Location: ./wp-content/themes/the-bootstrap/category.php */