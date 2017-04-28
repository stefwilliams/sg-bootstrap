<?php

/** category.php

 *

 * The template for displaying Category Archive pages.

 *

 * @author		Konstantin Obenland

 * @package		The Bootstrap

 * @since		1.0.0 - 05.02.2012

 */



get_header(); ?>



<section id="primary" class="span12">



	<?php tha_content_before(); ?>

	<div id="content" role="main">

		<?php 

		// tha_content_top();



		if ( have_posts() ) : ?>



		<h2>Our Featured Music</h2>

		<hr />



			<?php

			while ( have_posts() ) {

				the_post();

				

				echo category_description( get_cat_ID( 'music' ) );

				if (in_category('music')) {

					get_template_part( '/partials/content', get_post_format() );

				}

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