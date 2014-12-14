<?php
/*
Template Name: Encontro Page
*/

/** main.php

 *

 * The template for displaying Encontro-related content.

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

		// tha_content_top();

		if ( have_posts() ) : ?>



			<?php

			while ( have_posts() ) {

				the_post();

					get_template_part( 'encontro/content' );


			}

			the_bootstrap_content_nav();

		else :

			get_template_part( '/partials/content', 'not-found' );

		endif;

		

		tha_content_bottom(); ?>

	</div><!-- #content -->

	<?php tha_content_after(); ?>

</section><!-- #primary -->




<?php





// get_sidebar();

get_footer();





/* End of file index.php */

/* Location: ./wp-content/themes/the-bootstrap/category.php */