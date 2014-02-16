<?php
define( 'BP_DEFAULT_COMPONENT', 'profile');
// define( 'BP_GROUPS_DEFAULT_EXTENSION', 'members' );
// define ( 'BP_FRIENDS_SLUG', 'butties' );

/*BuddyPress custom nav*/
function rename_and_remove_bp_sections (){
	global $bp;
	$bp_group_slugtogo = bp_get_current_group_slug();
	//bp_core_remove_nav_item('events');
	//bp_core_remove_nav_item('forums');
	//bp_core_remove_subnav_item($bp_group_slugtogo, 'events');
	//bp_core_remove_subnav_item($bp_group_slugtogo, 'home');
	
	// $bp->bp_nav['butties']['name'] = 'Butties';
}
add_action( 'wp', 'rename_and_remove_bp_sections', 1 );

// Change the Profile nav tab order 
function change_profile_tab_order() {
	global $bp; 
	$order = 'profile,settings,groups,activity,messages'; // Add the component slugs coma separated in the order you like to have the nav menu tabs
	$order = str_replace(' ','',$order); 
	$order = explode(",", $order);
	$i = 1;
	foreach($order as $item) {
		$bp->bp_nav[$item]['position'] = $i;
		$i ++;
	}
}
add_action( 'wp', 'change_profile_tab_order', 2 );
 
/* Change the Group nav tab order
function change_groups_tab_order() {
	global $bp;
 
	$order = ''; // Add the component slugs coma separated in the order you like to have the nav menu tabs
 
	$order = str_replace(' ','',$order); 
	$order = explode(",", $order);
	$i = 1;
	foreach($order as $item) {
		$bp->bp_options_nav['groups'][$item]['position'] = $i;
		$i ++;
	}
}
add_action('wp', 'change_groups_tab_order');*/

// Exclude Members from directory listing

add_action('bp_ajax_querystring','bpdev_exclude_users',20,2);
function bpdev_exclude_users($qs=false,$object=false){
 //list of users to exclude 
 $excluded_user='3,5';//comma separated ids of users whom you want to exclude 
 if($object!='members')//hide for members only
 return $qs; 
 $args=wp_parse_args($qs); 
 //check if we are listing friends?, do not exclude in this case
 if(!empty($args['user_id']))
 return $qs;
 if(!empty($args['exclude']))
 $args['exclude']=$args['exclude'].','.$excluded_user;
 else
 $args['exclude']=$excluded_user; 
 $qs=build_query($args); 
 return $qs; 
}

?>