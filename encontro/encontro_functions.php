<?php 
/*add stylesheets to encontro pages only*/
function encontro_add_stylesheets() {

	wp_register_style(				

		'sg-encontro',				

		get_stylesheet_directory_uri() . "/encontro/encontro.css",

		false,

		'all'

	);
	
	if (is_page_template("encontro/main.php" ) || is_page_template("encontro/leaders.php" )) {

		wp_enqueue_style ('sg-encontro');
	}
}



add_action( 'wp_enqueue_scripts', 'encontro_add_stylesheets' );



function sg_encontro_check() {
global $post;
$pt = get_post_type( $post->ID );
// $ref = wp_get_referer();
// print_r($ref);


	if ($pt == "post") {

		$encontro_cat = get_term_by( 'name', 'encontro', 'category');
		$encontro_cat_id = $encontro_cat->term_id;

		
		$cat_array = get_the_category( $post->ID );
		$cat = $cat_array[0]->slug;

		$cat_parent = $cat_array[0]->category_parent;

		if (($cat == "leaders") && $cat_parent == $encontro_cat_id) {
			wp_enqueue_style ('sg-encontro');
			get_template_part( 'encontro/leader');
			exit;
		}


		if (($cat == "encontro") || $cat_parent == $encontro_cat_id) {
			wp_enqueue_style ('sg-encontro');
			get_template_part( 'encontro/main');
			exit;
		}

	}
	if ($pt == "event") {
			global $EM_Event;
			$encontro_term = get_term_by( 'name', 'encontro', 'event-categories');
			$encontro_term_id = $encontro_term->term_id;
			$sub_cats = get_term_children( $encontro_term_id, 'event-categories' );
			$event_cat = $EM_Event->output('#_CATEGORYID');
			if (in_array($event_cat, $sub_cats)) {
				wp_enqueue_style ('sg-encontro');
				get_template_part( 'encontro/main');
				exit;
				// exit;
			}
	}	

}