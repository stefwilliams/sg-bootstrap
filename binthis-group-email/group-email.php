<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php');
global $wpdb;
global $bp;
$pluginsurl = plugins_url('buddypress');
include ($pluginsurl/bp-messages/bp-messages-functions.php);



$sg_group_members = groups_get_group_members ( 
	array(
		'group_id'=>$sg_group_id
		//'exclude_admins_mods'=>false (doesn't seem to work)
		)
	);	
$sg_group_members = $sg_group_members[members];

$sg_group_admins = groups_get_group_admins ( 
	array(
		'group_id'=>$sg_group_id
		)
	);	
$sg_group_mods = groups_get_group_mods ( 
	array(
		'group_id'=>$sg_group_id
		)
	);	

$sg_all_group_members = array();

foreach ($sg_group_members as $member) {
	array_push($sg_all_group_members, $member->user_id);
}
foreach ($sg_group_admins as $member) {
	array_push($sg_all_group_members, $member->user_id);
}
foreach ($sg_group_mods as $member) {
	array_push($sg_all_group_members, $member->user_id);
}





//sg_group_email ();

function sg_group_email (){

$msg_args = 	array (
		'sender_id' => '2',
		'recipients' => array('15'),
		'subject' => 'test',
		'content' => 'first test'
		);

messages_new_message ($msg_args);
}
?>
