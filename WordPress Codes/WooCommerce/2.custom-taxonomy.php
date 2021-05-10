<?php


// Custom (Author) Taxonomy
function add_product_authors(){
    // Car Hunts
       $cAuthor_labels = array(
           'name'              => __( 'Authors', 'pixar' ),
           'singular_name'     => __( 'Author', 'pixar' ),
           'search_items'      => __( 'Search Authors', 'pixar' ),
           'all_items'         => __( 'All Authors', 'pixar' ),
           'parent_item'       => __( 'Parent Author', 'pixar' ),
           'parent_item_colon' => __( 'Parent Author:', 'pixar' ),
           'edit_item'         => __( 'Edit Author', 'pixar' ),
           'update_item'       => __( 'Update Author', 'pixar' ),
           'add_new_item'      => __( 'Add New Author', 'pixar' ),
           'new_item_name'     => __( 'New Author', 'pixar' ),
           'menu_name'         => __( 'Authors', 'pixar' ),
       );
       $cAuthor_args = array(
       'labels' => $cAuthor_labels,
       'hierarchical'               => true,
       'public'                     => true,
       'show_ui'                    => true,
       'show_admin_column'          => true,
       'show_in_nav_menus'          => true,
       'show_tagcloud'              => true,
       'query_var' => true,
       'rewrite' => array( 'slug' => 'product-author' )
       );
       register_taxonomy( 'product_author', 'product', $cAuthor_args );
   }
   add_action( 'init', 'add_product_authors', 0 );
   
       /* Flush rewrite rules for custom post types. */
   add_action( 'after_switch_theme', 'flush_rewrite_rules' );
