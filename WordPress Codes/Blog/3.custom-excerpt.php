<?php




/*
 * Read More Option
*/
function posts_custom_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'posts_custom_excerpt_length', 999);
/*
 * Read More Link Text
*/
function new_excerpt_more($more) {
    global $post;
 return '<a class="read-more" href="'. get_permalink($post->ID) . '"> Read more...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
