<?php
function sg_em_add_paypal_surcharge($paypal_vars, $EM_Booking, $EM_Gateway_Paypal){
    $amount = $EM_Booking->get_price($force_refresh, false, $add_tax);
    $amount = ($amount * .042 + 0.2);
    $amount = round($amount, 2);

    if ( !empty($amount) ){
        $itemcount = (count($EM_Booking->get_tickets_bookings()->tickets_bookings) + 1);
        $paypal_vars['item_name_'.$itemcount] = wp_kses_data("Surcharge");
        $paypal_vars['quantity_'.$itemcount] = 1;
        $paypal_vars['amount_'.$itemcount] = $amount;
    }
    return $paypal_vars;
}
add_filter('em_gateway_paypal_get_paypal_vars','sg_em_add_paypal_surcharge',1,3);
?>