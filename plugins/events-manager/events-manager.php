<?php
// add_action('em_booking_form_custom', 'sg_em_make_uk_default', 1, 1);
// add_filter( 'em_booking_form_get_form_template', 'sg_em_make_uk_default', 5, 1 );
// function sg_em_make_uk_default($form_template) {
//     global $EM_Booking_Form;
    // error_log(var_export($EM_Event, true));
    // ob_start();
    // var_dump($EM_Event);
    // $emdump = ob_get_clean();
    // echo "<pre>";
    // print_r($emdump);
    // echo "</pre>";


//     ob_start();
// $vars = get_defined_vars();
//     var_dump($vars);
//     $emdump = ob_get_clean();


// echo "<pre>";
// error_log(var_export($EM_Booking_Form->{'form_template'}, true));
// echo "</pre>";
// return $form_template;
// return $EM_Event;
    // print_r($EM_Event);
    // return $EM_Event;
// }

//{has_leaders} conditional
add_action('em_event_output_condition', 'my_em_styles_event_output_condition', 1, 4);
function my_em_styles_event_output_condition($replacement, $condition, $match, $EM_Event){
    $leader_ids = get_post_meta( $EM_Event->post_id, 'event_leaders', true);
    if( is_object($EM_Event) && preg_match('/^has_leaders/',$condition, $matches) && $leader_ids ){
        $replacement = preg_replace("/\{\/?$condition\}/", '', $match);
    }
    
    return $replacement;
}


//#_LEADERS placeholder
add_filter('em_event_output_placeholder','my_em_styles_placeholders',1,3);
function my_em_styles_placeholders($replace, $EM_Event, $result){
    global $wp_query;
    switch( $result ){
        case '#_LEADERS':
        $replace = '';
        $leader_ids = get_post_meta( $EM_Event->post_id, 'event_leaders', true);
        $leaders = array();
        foreach ($leader_ids as $leader_id) {
            $leaders[] = '<a href="'.post_permalink($leader_id).'">'.get_the_title( $leader_id ).'</a>';
        }
            // print_r($leaders);
        $replace = implode(', ', $leaders);
    }
    return $replace;
}


//get post_id from [event] shortcode
function get_event_id_from_shortcode($content) {
    //find the shortcodes
    $pattern = get_shortcode_regex();
    preg_match_all("/".$pattern."/",$content,$matches);    
        //find 'event' in the array
    if (in_array('event', $matches[2])) {
            //get the event attributes
        $event_atts = $matches[3][0];
            //find 'post_id' in event attributes
        preg_match_all('/post_id="(.*?)"/', $event_atts, $id);
            //get value of post_id
            // print_r($id);
        $event_id = $id[1][0];
        return $event_id;
    }
}

//new meta box for event leaders
function add_event_leader_meta_box() { 
    add_meta_box('event_leaders', __('Event Leaders'), 'event_leaders_checklist', 'event', 'side', 'core'); 
} 

function event_leaders_checklist(){ 
    global $post;?>
    <p>Select the leader for this event. The list is compiled from every post that is categorized as 'Leader'.</p>
    <?php
    $args = array( 'posts_per_page' => '-1', 'category_name' => 'leaders', 'orderby' => 'title', 'order' => 'ASC' );
    $leaders = get_posts( $args );
    $event_leaders = get_post_meta($post->ID, 'event_leaders', true);
    // var_dump($event_leaders);
    foreach ($leaders as $leader) {
        if (is_array($event_leaders) && in_array($leader->ID, $event_leaders)) {
            $checked = 'checked';
        }
        else {
            $checked = NULL;
        }
        echo "<input type='checkbox' name='event_leaders[]' ".$checked." value='".$leader->ID."'/>".$leader->post_title."<br />";
    }
    // var_dump($event_leaders);
    wp_nonce_field( plugin_basename( __FILE__ ), 'event_leaders_nonce' );?><?php
}

add_action( 'admin_init', 'add_event_leader_meta_box' ); 

//new meta box for band info
function add_band_info_meta_box() { 
    add_meta_box('band_info', __('Info for Band Members'), 'band_info_wysiwyg', 'event', 'normal', 'high'); 
} 

function band_info_wysiwyg(){ 
    global $post;
    $band_info = get_post_meta($post->ID, 'bandinfo', true);
    wp_nonce_field( plugin_basename( __FILE__ ), 'bandinfo_nonce' );?>
    <p>Put instructions and other band-specific info in here. Stuff that is NOT for the public.</p>
    <?php wp_editor( $band_info, 'bandinfo');?>
    <?php
}

add_action( 'admin_init', 'add_band_info_meta_box' ); 

//save custom band_info
function save_event_customfields($post_ID){
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
    if ( ! isset( $_POST['event_leaders_nonce'] ) || ! wp_verify_nonce( $_POST['event_leaders_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    // Thirdly check the post type
    if ('event' != get_post_type($post_ID))
        return;
    $bandinfo =  $_POST['bandinfo'];
    $event_leaders = $_POST['event_leaders'];
    // error_log(var_export($_POST,true));
    // Do something with $bandinfo 
    update_post_meta( $post_ID, 'bandinfo', $bandinfo);
    update_post_meta( $post_ID, 'event_leaders', $event_leaders);
}

/* save the data */
add_action( 'save_post', 'save_event_customfields' );

/* Display the data on-screen */
function insert_band_info($content) {
    global $post;
    global $EM_Event;
    $enquiry_alert = '<div class="alert alert-warning"><strong>NOTE: </strong>This is currently just a gig enquiry, but we still need to know who can attend.</div>';    
    if (has_shortcode ($content, 'event')) {
        $event_id = get_event_id_from_shortcode($content);
    }
    elseif( is_single() && $post->post_type == 'event' && is_user_logged_in () ){  
        $event_id = $post->ID;

    //now we know what event_id we're on about...
        $event_cats = wp_get_post_terms( $event_id, 'event-categories' );
        $bandinfo = wpautop(get_post_meta( $event_id, 'bandinfo', true));
        # code...

        if ($bandinfo && is_user_logged_in()) {
            foreach ($event_cats as $cat) {
                if (isset($cat->name) && $cat->name =='Enquiry') {
                   $output = $enquiry_alert.$bandinfo;
                   return $output.$content;
               }
               elseif (is_user_logged_in()) {
                  $output = $bandinfo;
                  return $output.$content;
              } 
              else {
                return $content;
            }
        }
    }
    else {
        return $content;
    }


}
else {
    return $content;
}

}

add_filter('the_content','insert_band_info',10,1);
?>