<?php

/**
 * ---------------------------------
 * Add a custom product data tab
 * ---------------------------------
 */
// Author
add_filter('woocommerce_product_tabs', 'woo_new_product_author_tab');
function woo_new_product_author_tab($tabs)
{
    // Adds the Author tab
    $tabs['author_tab'] = array(
        'title'     => __('লেখক', 'woocommerce'),
        'priority'     => 50,
        'callback'     => 'woo_new_product_author_tab_content'
    );
    return $tabs;
}
function woo_new_product_author_tab_content()
{
    // The new tab content

    $terms = get_the_terms($post->ID, 'product_author');
    if (!$terms  == '') {

        foreach ($terms as $term) {
            $term_link = get_term_link($term, 'product_author');
            $t_id = $term->term_id;
            $term_meta = get_option( "product_author_$t_id" ); 
            $term_image = $term_meta['image'];
            if (is_wp_error($term_link))
                continue;
            echo '<div class="row">';
            echo '<div class="col-lg-2 col-md-2 col-sm-12 col-12">
            <div class="author-img-wrap">';
            if($term_image){
                echo '<img src="'.$term_image.'" alt="Author">';
            }
                
            echo '</div></div>';
            echo '<div class="col-lg-10 col-md-10 col-sm-12 col-12"><div class="author-description">';
            echo '<h3><a href="' . $term_link . '">' . $term->name . '</a></h3>';
            echo '<p class="mt-2">' . $term->description . '</p>';
            echo '</div></div>';
            echo '</div>';
        }
    }
}

/**
 * --------------------------------------------
 * Add a custom product data tab End here
 * --------------------------------------------
 */


/* ----------------------------------------------
    Single products review form
-------------------------------------------*/
/**
 * Remove product data review tabs
 */
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs)
{
    unset($tabs['reviews']);             // Remove the reviews tab
    return $tabs;
}
/*
 Renaming Tabs Title
*/
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	$tabs['description']['title'] = __( 'বিবরন' );		// Rename the description tab
	$tabs['additional_information']['title'] = __( 'অন্যান্য তথ্য' );	// Rename the additional information tab

	return $tabs;
}