<?php
//called from /sg-bootstrap/plugins/events-manager/forms/bookingform
//check if ticket list should show radio buttons so only one ticket type allowed
function sg_em_one_ticket_allowed($EM_Event, $EM_Tickets) {
    $a = 0;
    if ($EM_Event->event_rsvp_spaces > 1) {
        return false;
    }
    foreach ($EM_Tickets as $ticket) {
        if (($ticket->ticket_min == 1) && ($ticket->ticket_max == 1)) {
            $a = $a + 1;
        }
        else
        {
            return false;
        }
    }

    if (count($EM_Tickets->tickets) == $a) {
        return true;
    }
    else {
        return false;
    }
}

//hook into em_booking_get_post_pre to convert radio button data to expected $_REQUEST output
add_action( 'em_booking_get_post_pre', 'sg_em_add_one_ticket_allowed', 16, 1 );
function sg_em_add_one_ticket_allowed($this) {
   if (isset($_POST['one_and_only_one'])) {
        $event_id = $_POST['one_and_only_one'];
        $_REQUEST['em_tickets'][$event_id]['spaces'] = 1;
        $_REQUEST['em_attendee_fields'][$event_id]['attendee_name'][0] = "Main Event Booker";
    }
    else {
        return $_REQUEST;
    }
}

?>