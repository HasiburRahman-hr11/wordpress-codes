<?php
/*

*** Add this code in your functions.php file ***

*** Custom Comment Templates ***
*** Comments Lists ****
*/
if (!function_exists('shape_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since Shape 1.0
     */
    function shape_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type):
            case 'pingback':
            case 'trackback':
            ?>
                <li class="post pingback">
                    <p><?php _e('Pingback:', 'shape'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'shape'), ' '); ?></p>
                <?php
                break;
            default:
                ?>
                <li class="comment-list" id="li-comment-<?php comment_ID(); ?>">
                    <div class="comment-avater">
                        <?php echo get_avatar($comment, 70); ?>
                        <p class="comment-author"><?php comment_author(); ?></p>
                    </div><!-- .comment-author .vcard -->
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em><?php _e('Your comment is awaiting moderation.', 'shape'); ?></em>
                        <br />
                    <?php endif; ?>


                    <div class="comment-text">
                        <?php comment_text(); ?>
                        <div class="comment-meta">
                            

                            <span class="comment-date"><time pubdate datetime="<?php comment_time('c'); ?>"> On
                                    <?php
                                    /* translators: 1: date, 2: time */
                                    printf(__('%1$s at %2$s', 'shape'), get_comment_date(), get_comment_time()); ?>
                                </time></span>
                            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"></a>
                            <?php edit_comment_link(__('(Edit)', 'shape'), ' ');
                            ?>
                        </div>
                        <div class="comment-reply">
                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div><!-- .reply -->
                    </div>
    <?php
                break;
        endswitch;
    }
endif; // ends check for shape_comment()




/**
 * Comment Form Placeholder Author, Email, URL
*/
function placeholder_author_email_url_form_fields($fields) {
    $replace_author = __('Your Name', 'portfolio');
    $replace_email = __('Your Email', 'portfolio');
    $replace_url = __('Your Website', 'portfolio');
    
    $fields['author'] = '<p class="comment-form-author">' . 
                    '<input id="author" name="author" type="text" placeholder="'.$replace_author.'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></p>';
                    
    $fields['email'] = '<p class="comment-form-email">' .
    '<input id="email" name="email" type="text" placeholder="'.$replace_email.'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url">' .
    '<input id="url" name="url" type="text" placeholder="'.$replace_url.'" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>';
    
    return $fields;
}
add_filter('comment_form_default_fields','placeholder_author_email_url_form_fields');

/**
 * Comment Form Placeholder Comment Field
 */
function placeholder_comment_form_field($fields) {
    $replace_comment = __('Your Thoughts', 'portfolio');
     
    $fields['comment_field'] = '<p class="comment-form-comment">' .
    '<textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.$replace_comment.'" aria-required="true"></textarea></p>';
    
    return $fields;
 }
add_filter( 'comment_form_defaults', 'placeholder_comment_form_field' );


/**
 * Moving the textarea to bottom of the form
 */
function wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
    }
     
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );