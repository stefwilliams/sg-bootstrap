<?php
/*disable FEE on specific pages
Add and Edit Events - 53
Add and Edit Documents - 134
Admin - 182
Forums - 244
*/
function fee_disable( $allow, $args ) {
	$disabled_post_ids = array( 53, 134, 182, 244 );

	return $allow && !in_array( $args['post_id'], $disabled_post_ids );
}
add_filter('front_end_editor_allow_post', 'fee_disable', 10, 2);



?>