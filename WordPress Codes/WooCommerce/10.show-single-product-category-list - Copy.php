<?php

 
// Category
function single_product_categorie_lists()
{

    $terms = get_the_terms($post->ID, 'product_cat');

    if (!$terms == '') {
        echo '<div class="details-book-product-category">
        <span class="product-meta-prefix">Categories: </span>';
        foreach ($terms as $term) {
            $term_link = get_term_link($term, 'product_cat');
            if (is_wp_error($term_link))
                continue;

            echo '<a href="' . $term_link . '">' . $term->name . '</a> ';
        }
        echo '</div>';
    }
}
add_action('woocommerce_single_product_summary', 'single_product_categorie_lists', 8);