<?php

 
 // Pagination
 function filter_woocommerce_pagination_args( $paged ) { 
    $paged = array( 'prev_next'=> false, 'type' => 'list', 'end_size' => 1, 'mid_size' => 2 );
    return $paged; 
}; 
add_filter( 'woocommerce_pagination_args', 'filter_woocommerce_pagination_args', 10, 1 ); 
