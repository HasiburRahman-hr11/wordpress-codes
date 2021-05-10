<?php 
// custom meta boxes
// ==========================================
function slider_meta_boxes()
{
    add_meta_box(
        'slider-meta',
        'Custom Fields for Slider',
        'slider_mata_callback',
        'post'
    );
}
add_action('add_meta_boxes', 'slider_meta_boxes');

function slider_mata_callback($post)
{
?>

    <label for="slider_title"> Title</label>
    <p>
        <input class="widefat" type="text" name="sltitle" id="slider_title" value="<?php echo get_post_meta($post->ID, 'sltitle', true) ?>">
    </p>
    <label for="slider_subtitle"> Subtitle</label>
    <p>
        <input class="widefat" type="text" name="slsub" id="slider_subtitle" value="<?php echo get_post_meta($post->ID, 'slsub', true) ?>">
    </p>
    <label for="slider_button"> Text</label>
    <p>
        <input class="widefat" type="text" name="slbutton" id="slider_button" value="<?php echo get_post_meta($post->ID, 'slbutton', true) ?>">
    </p>
    <label for="slider_button_url"> Url</label>
    <p>
        <input class="widefat" type="url" name="slbuttonurl" id="slider_button_url" value="<?php echo get_post_meta($post->ID, 'slbuttonurl', true) ?>">
    </p>
<?php
}

function saving_meta_data($post_id)
{
    update_post_meta($post_id, 'sltitle', $_POST['sltitle']);
    update_post_meta($post_id, 'slsub', $_POST['slsub']);
    update_post_meta($post_id, 'slbutton', $_POST['slbutton']);
    update_post_meta($post_id, 'slbuttonurl', $_POST['slbuttonurl']);
}
add_action('save_post', 'saving_meta_data');