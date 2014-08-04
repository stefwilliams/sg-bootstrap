<?php
function remove_event_excerpt_support() {
remove_post_type_support( 'event', 'excerpt' );
}

add_action( 'init', 'remove_event_excerpt_support', 10 );

//new meta box for band info
function add_band_info_meta_box() { 
	add_meta_box('band_info', __('Info for Band Members'), 'band_info_wysiwyg', 'event', 'normal', 'high'); 
	
} 

function band_info_wysiwyg(){ 
	global $post;
	
	$band_info = get_post_meta($post->ID, 'bandinfo', true);
	// $settings = array();
	wp_nonce_field( plugin_basename( __FILE__ ), 'bandinfo_nonce' );?>
	<p>Put instructions and other band-specific info in here. Stuff that is NOT for the public.</p>
	<?php wp_editor( $band_info, 'bandinfo', $settings);?>
	
	<?php
}

add_action( 'admin_init', 'add_band_info_meta_box' ); 


//save custom band_info
function save_band_info_customfield($post_ID){
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    // First we need to check if the current user is authorised to do this action. 
    if ( ! current_user_can( 'edit_post', $post_ID ) )
        return;

    // Secondly we need to check if the user intended to change this value.
    if ( ! isset( $_POST['bandinfo_nonce'] ) || ! wp_verify_nonce( $_POST['bandinfo_nonce'], plugin_basename( __FILE__ ) ) )
      return;

    // Thirdly check the post type
    if ('event' != get_post_type($post_ID))
        return;

    $mydata =  $_POST['bandinfo'];
// error_log(var_export($_POST,true));
    // Do something with $mydata 
    // either using 
    update_post_meta( $post_ID, 'bandinfo', $mydata);

}
/* saved the data */
add_action( 'save_post', 'save_band_info_customfield' );



//sg_event_description_tag() is a safety net to ensure that excerpts are not used for FB description tags. ome have had to have a characterinserted to avoid breaking single event pages.


function sg_event_description_tag( $tags ) {

    global $post;

    $pt = get_post_type( $post );
// print_r($pt);

    if (get_post_type( $post ) == 'event') {

        // Remove the default description added by Jetpack
        unset( $tags['og:description'] );

        $content = $post->post_content;
        $tags['og:description'] = strip_tags($content);
        // print_r($tags);
    }
    return $tags;  
}
add_filter( 'jetpack_open_graph_tags', 'sg_event_description_tag' );


?>