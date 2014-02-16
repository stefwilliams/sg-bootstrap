<?php
/*This receives the data from the form in sidebar-group-email.php and uses the main bbpress function to insert the post into the forum.*/
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php');
global $wpdb;
global $bp;
$pluginsurl = plugins_url('bbpress');
include ($pluginsurl/includes/topics/functions.php);

$user_id = $_POST [userid];
$forum_id = $_POST [forumid];
$user_ip = $_POST [userip];
$title = $_POST [title];
$content = $_POST [content];
$content = '<p>This message was sent by a non-member of this group: </p>'.$content;


	$topic_data = array(
		'post_parent'    => $forum_id, // forum ID
		'post_status'    => bbp_get_public_status_id(),
		'post_type'      => bbp_get_topic_post_type(),
		'post_author'    => $user_id,
		'post_password'  => '',
		'post_content'   => $content,
		'post_title'     => $title,
		'comment_status' => 'closed',
		'menu_order'     => 0,
	);

	$topic_meta = array(
		'author_ip'          => $user_ip,
		'forum_id'           => $forum_id,
		'topic_id'           => $topic_id,
		'voice_count'        => 1,
		'reply_count'        => 0,
		'reply_count_hidden' => 0,
		'last_reply_id'      => 0,
		'last_active_id'     => $topic_id,
		'last_active_time'   => get_post_field( 'post_date', $topic_id, 'db' ),
	);
$topic_id = bbp_insert_topic($topic_data, $topic_meta);
?>
<script>
alert ('<?php echo $topic_id; ?>');
</script>

<?php
bp_core_add_notification( $topic_id, $user_id, 'forum_notifier', 'new_topic_' . $topic_id, $forum_id );


//bbp_add_user_subscription ($user_id, $topic_id);


?>