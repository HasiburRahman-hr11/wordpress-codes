<?php

/*
    // Live Cart count change
*/
add_filter('woocommerce_add_to_cart_fragments', 'ridgewood_cart_count_fragments', 10, 1);

function ridgewood_cart_count_fragments($fragments)
{
    $fragments['span.wide_nav-cart_contents'] = '
    <span class="wide_nav-cart_contents">' . WC()->cart->get_cart_contents_count() . '</span>';

    // $fragments['span.fl-cart-amount'] = '
    // <span class="fl-cart-amount">' . WC()->cart->get_cart_total() . '</span>';

    return $fragments;
}

/*
    // Live Cart count change end
*/