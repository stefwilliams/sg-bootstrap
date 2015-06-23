<?php		
/** functions.php 
* * @author		Stef Williams 
* @package		sg-bootstrap 
* @since		1.0.0 - 02.12.2012
*/
require_once('encontro/encontro_functions.php' );
/*load plugin specific over-rides and functions*/
require_once('plugins/buddypress.php' );
require_once('plugins/thememylogin.php' );
require_once('plugins/events-manager/events-manager.php' );
require_once('plugins/events-manager/events-manager-surcharge.php' );
require_once('plugins/events-manager/events-manager-oneticketonly.php' );
/**

* separate media categories from post categories

* use a custom category called 'category_media' for the categories in the media library

*/
function sg_custom_img_sizes() {
	 // add_image_size( 'category-thumb', 300 ); // 300 pixels wide (and unlimited height)
  // 	add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)
	add_image_size( 'carousel', 960, 540, array('left','center') );
}
add_action( 'after_setup_theme', 'sg_custom_img_sizes' );

add_filter( 'wpmediacategory_taxonomy', function(){ return 'category_media'; } ); //requires PHP 5.3 or newer

//add Jetpack 'Publicize' functionality to Events CPT
add_action('init', 'sg_publicize_events');
//prevent 'the bootstrap' gallery hook from running - it breaks Jetpack - NOTE: this function is in the main theme's functions.php - doesn't have any effect here - this is just for ref.

remove_filter( 'post_gallery', 'the_bootstrap_post_gallery', 10, 2 );

function sg_publicize_events() {
	add_post_type_support( 'event', 'publicize' );
}

//change default 'publicize' value on new posts
add_filter( 'publicize_checkbox_default', '__return_false' );

function exclude_tags_based_on_roles($query) {
	if (is_category('web-help')) {
		$user_id = get_current_user_id();
		$role = get_user_role ($user_id);
		$admin_tag = get_term_by('slug', 'samba_admin', 'post_tag');
		$editor_tag = get_term_by('slug', 'samba_editor', 'post_tag');

		if ($role == "samba_editor") {
			$ignore_tags = array( 
				$admin_tag->term_id
				);
			$query->set('tag__not_in', $ignore_tags);
		}
		if ($role == "samba_player") {
			$ignore_tags = array( 
				$admin_tag->term_id,
				$editor_tag->term_id,
				);
			$query->set('tag__not_in', $ignore_tags);
		}		
		return;
	}
}

add_action( 'pre_get_posts', 'exclude_tags_based_on_roles', 1 );

function get_user_role( $user_id ){
	$user_data = get_userdata( $user_id );
	if(!empty( $user_data->roles ))
		return $user_data->roles[0];
	return false; 
}

/*add custom stylesheets*/

function sg_add_stylesheets() {
	wp_register_style(				
		'sg-bootstrap-slate',				
		get_stylesheet_directory_uri() . "/css/slate-overrides.css",
		false,
		'all'
		);

	wp_register_style(				
		'sg-bootstrap-wps',				
		get_stylesheet_directory_uri() . "/css/bbpress-overrides.css",
		false,
		'all'
		);

	// wp_register_script(  );
	wp_enqueue_script( 'modalfix', get_stylesheet_directory_uri() . "/js/modalfix.js", 'twitter-bootstrap', '0.1', true);
	wp_enqueue_style ('sg-bootstrap-slate');
	wp_enqueue_style('sg-bootstrap-wps');
}

add_action( 'wp_enqueue_scripts', 'sg_add_stylesheets' );

/*alter header image dimensione*/
function sg_header_image_width($args){
	$args = 100;
	return $args;
}

function sg_header_image_height($args){
	$args = 100;
	return $args;
}

add_filter ('the_bootstrap_header_image_width', 'sg_header_image_width', 1, 1);
add_filter ('the_bootstrap_header_image_height', 'sg_header_image_height', 1, 1);

/*New widget areas*/
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'          => __( 'Homepage Column 1', 'sg-bootstrap' ),
		'id'   			=> 'homepage-col1',
		'before_widget' => '<aside id="%1$s" class="widget well %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
}

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'          => __( 'Homepage Column 2', 'sg-bootstrap' ),
		'id'   			=> 'homepage-col2',
		'before_widget' => '<aside id="%1$s" class="widget well %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
}

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'          => __( 'Dash Column 1', 'sg-bootstrap' ),
		'id'   			=> 'member-dash-col1',
		'before_widget' => '<aside id="%1$s" class="widget well %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
}

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'          => __( 'Dash Column 2', 'sg-bootstrap' ),
		'id'   			=> 'member-dash-col2',
		'before_widget' => '<aside id="%1$s" class="widget well %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
}

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'          => __( 'Dash Column 3', 'sg-bootstrap' ),
		'id'   			=> 'member-dash-col3',
		'before_widget' => '<aside id="%1$s" class="widget well %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
}

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'          => __( 'Dash Column 4', 'sg-bootstrap' ),
		'id'   			=> 'member-dash-col4',
		'before_widget' => '<aside id="%1$s" class="widget well %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
}

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'          => __( 'Header Login', 'sg-bootstrap' ),
		'id'   			=> 'header-login',
		'before_widget' => '<div id="%1$s" class="header widget %2$s span3 hidden-phone">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
}
?>