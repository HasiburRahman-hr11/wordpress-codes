<?php
/*
*** Custom Post type for Works
*/
function my_portfolio_works() {
    $labels = array(
        'name'                         => _x( 'Works', 'portfolio' ),
        'singular_name'           => _x( 'Work', 'portfolio' ),
        'add_new'                   => _x( 'Add New', 'portfolio' ),
        'add_new_item'          => __( 'Add New Work' ),
        'edit_item'                  => __( 'Edit Work' ),
        'new_item'                 => __( 'New Work' ),
        'all_items'                   => __( 'All Works' ),
        'view_item'                 => __( 'View Work' ),
        'search_items'            => __( 'Search Works' ),
        'not_found'                => __( 'No Works found' ),
        'not_found_in_trash' => __( 'No Works found in the Trash' ), 
        'menu_name'            => 'Works'
      );
      $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our Works and Work specific data',
        'public'        => true,
        'menu_position' => 22,
        'rewrite' => array('slug' => 'Works'),
        'supports'      => array( 'title', 'thumbnail' , 'editor' ),
        'has_archive'   => true,
      );
      register_post_type( 'work_post', $args ); 
}
add_action('init', 'my_portfolio_works');

/*
To make single-{post-type}.php template work call this function
*/
flush_rewrite_rules( false );