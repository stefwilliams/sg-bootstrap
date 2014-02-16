<?php
add_action('bp_ajax_querystring','bp_only_samba_users',20,2);
function bp_only_samba_users($qs=false,$object=false){

	$roles = array('samba_admin', 'samba_player', 'samba_editor');
	$included_user = array();
	foreach ($roles as $role) {

		$userargs = array(
			'role' => $role,
			'fields' => array('ID')
			);
		$users = get_users( $userargs );

		foreach ($users as $user) {
			array_push($included_user, $user->ID);
		}
	}

	$included_user = implode(',',$included_user);
// print_r($rsvp_user_list_roles);


// this code lifted from: 
// http://buddydev.com/buddypress/exclude-users-from-members-directory-on-a-buddypress-based-social-network/

 //list of users to include
 // $included_user='1,2,3';//comma separated ids of users whom you want to include

 if($object!='members')//hide for members only
 return $qs;
 
 $args=wp_parse_args($qs);
 
 //check if we are listing friends?, do not include in this case
 if(!empty($args['user_id'])||!empty($args['search_terms'])) //<=remove OR search terms condition to remove users from search
 return $qs;
 
 if(!empty($args['include']))
 	$args['include']=$args['include'].','.$included_user;
 else
 	$args['include']=$included_user;
 
 $qs=build_query($args);
 
 return $qs;
}
//remove events manager nav from profile and group page
function remove_em_nav() {
	global $bp;
	//remove from groups
	if (function_exists('bp_core_remove_subnav_item')) {
		bp_core_remove_subnav_item($bp->groups->slug,'group-events');
		bp_core_remove_subnav_item($bp->groups->current_group->slug,'events');
	}

	//remove from profile page
	if (function_exists('bp_core_remove_nav_item')) {
		bp_core_remove_nav_item( 'events' );
		bp_core_remove_nav_item('notifications');
	}

}
add_action( 'init', 'remove_em_nav' );

function sg_rename_group_home_tab() {
  global $bp;
  if (isset($bp->groups->current_group->slug) && $bp->groups->current_group->slug == $bp->current_item) {
    $bp->bp_options_nav[$bp->groups->current_group->slug]['home']['name'] = 'Archive';
  }
}
add_action('bp_init', 'sg_rename_group_home_tab');


//Remove Notifications tab
function remove_notifications_subnav(){
global $bp;
// if ( $bp->current_component == $bp->profile->slug ) {
// }
}
add_action( 'init', 'remove_notifications_subnav');


// function bbg_change_tabs() {

// global $bp;
// $bp->bp_nav = 'New Profile Verbiage';
// $bp->bp_nav = 'New Activity Verbiage';
// $bp->bp_nav = 'New Friends Verbiage';
// $bp->bp_nav = 'New Groups Verbiage';
// }
// add_action( 'bp_setup_nav', 'bbg_change_tabs', 999 );

// function redirect_to_members() {
// 	global $bp;
 
// 	$path = clean_url( $_SERVER['REQUEST_URI'] );
 
// 	$path = apply_filters( 'bp_uri', $path );
 
// 	if ( bp_is_group_home() && $bp->current_action == $bp->bp_options_nav['groups']['home']['slug'] )
// 		bp_core_redirect( apply_filters( 'bp_uri', $bp->bp_options_nav['groups']['admin']['link']) );
// }
// add_action( 'init', 'redirect_to_members' );




?>