<?php

/* 

 * Remember that this file is only used if you have chosen to override event pages with formats in your event settings!

 * You can also override the single event page completely in any case (e.g. at a level where you can control sidebars etc.), as described here - http://codex.wordpress.org/Post_Types#Template_Files

 * Your file would be named single-event.php

 */

/*

 * This page displays a single event, called during the the_content filter if this is an event page.

 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.

 * You can display events however you wish, there are a few variables made available to you:

 * 

 * $args - the args passed onto EM_Events::output() 

 */

global $EM_Event;

/* @var $EM_Event EM_Event */

// echo $EM_Event->output_single();

// echo "<pre style='overflow:scroll;height:500px;''>";
// print_r($EM_Event);
// echo "</pre>";

?>
<?php 
if (has_excerpt() && is_user_logged_in()) { ?>

<h3>Notes for Band Members</h3>
<?php if ($EM_Event->output('#_CATEGORYNAME') == "Gig Enquiry") {
	echo '<div class="alert alert-warning"><strong>NOTE: </strong>This is currently just a gig enquiry, but we still need to know who can attend.</div>';
}
	?>
<?php echo $EM_Event->output('#_EVENTEXCERPT'); ?>
<hr />

<?php 
} ?>
<p>

<div style="float:right; margin: 0px 0px 15px 15px" class="visible-desktop"><?php echo $EM_Event->output('#_LOCATIONMAP'); ?></div>
<div style="float:right; margin: 0px 0px 15px 15px" class="visible-tablet"><?php echo $EM_Event->output('#_LOCATIONMAP{300px,225px}'); ?></div>
<div style="float:right; margin: 0px 0px 15px 15px"  class="visible-phone text-center"><?php echo $EM_Event->output('#_LOCATIONMAP{278px,209px}'); ?></div>

		<?php if ( has_post_thumbnail() ) : ?>
		<?php 
			$img_atts = array(
				"class" => "thumbnail post-thumbnail span4",
				);
			the_post_thumbnail( 'large', $img_atts ); ?>
		<?php endif;?>

	<label>Date</label>
	<?php echo $EM_Event->output('#_EVENTDATES'); ?><br />
	<label>Time</label>
	<em><?php echo $EM_Event->output('#_EVENTTIMES'); ?></em>
	<label>Location</label>
	<?php echo $EM_Event->output('#_LOCATIONLINK'); ?>



<h4>Event Details</h4>
<?php echo $EM_Event->output('#_EVENTNOTES'); ?>
<?php if (($EM_Event->event_rsvp) != 0) { ?>
<h3>Bookings</h3>
<?php echo $EM_Event->output('#_BOOKINGFORM'); ?>
<?php }?>
