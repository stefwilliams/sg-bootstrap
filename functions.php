<?php		

/** functions.php 

* * @author		Stef Williams 

* @package		sg-bootstrap 

* @since		1.0.0 - 02.12.2012

*/

/*load plugin specific over-rides and functions*/
require_once('plugins/buddypress.php' );
require_once('plugins/thememylogin.php' );
require_once('plugins/events-manager/events-manager.php' );
// require_once('plugins/frontendeditor.php');

//

function exclude_tags_based_on_roles($query) {

	if (is_category('web-help')) {
		$user_id = get_current_user_id();
		$role = get_user_role ($user_id);
		$admin_tag = get_term_by('slug', 'samba_admin', 'post_tag');
		$editor_tag = get_term_by('slug', 'samba_editor', 'post_tag');

		// print_r($admin_tag->term_id);

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

//

/*shorten default excerpt*/

// add_filter('excerpt_length', 'sg_excerpt_length');
// function sg_excerpt_length($length) {
// return 15; // Or whatever you want the length to be.
// }


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