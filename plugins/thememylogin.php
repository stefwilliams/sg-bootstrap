<?php

/*Theme my login BP Profile link*/

add_filter( 'tml_user_links', 'insert_bp_profile_info', 20 );

function insert_bp_profile_info (){

	global $current_user;

	global $bp;

	$sg_username=$bp->loggedin_user->userdata->user_login;

	//echo '<pre>';

	//print_r($bp->loggedin_user);

	//echo '</pre>';

	get_currentuserinfo();

	$sg_user=$current_user->ID;

	//$sg_username=$current_user->user_login;
	if (function_exists('xprofile_get_field_data')) {
		$sg_instrument = xprofile_get_field_data('Your instrument', $sg_user);
	}
	else {
		$sg_instrument = 'Cannot retrieve instrument - is Buddypress installed and active?';
	}
	// $sg_frnd_req = bp_friend_get_total_requests_count();

	// $messages = messages_get_unread_count();

// 	$notifications = $notifications = bp_core_get_notifications_for_user( bp_loggedin_user_id(), 'object' );

// echo '<pre>';

// 	print_r($notifications);

// 	echo '</pre>';



	echo "<li>$current_user->display_name</li>";

if ($sg_instrument && ($sg_instrument != '--not specified--')) {

	echo "<li><em>$sg_instrument</em></li>";

	}

else {

	echo '<em>No instrument specified</em>';

	}

	// if ($messages > 0) {

	// echo '<li>You have <a href="/members-directory/'.$sg_username.'/messages/">'.$messages.' unread messages</li>';

	// }

	// else {

	// 	echo '<li>No new <a href="/members-directory/'.$sg_username.'/messages/">messages</a>';

	// }

// if ($sg_frnd_req>0)	{

// 	echo '<li>';

// 	echo "<a href='/members-directory/$sg_username/butties/requests/'>";

// 	echo $sg_frnd_req;

// 	echo ' butty request';

// 	if ($sg_friend_req>1) {

// 		echo 's';

// 	}

// 	echo '</a></li>';

// }

	if (function_exists('bp_loggedin_user_link')) {
		# code...

		echo "<li><br /><a href='";

		bp_loggedin_user_link();

		echo "'>Edit Profile</a></li>";
	}
	else {
		echo "Buddypress is not installed or is not active";
	}
}



?>