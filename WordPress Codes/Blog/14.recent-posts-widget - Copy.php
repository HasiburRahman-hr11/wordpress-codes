<?php


/**
 * Extend Recent Posts Widget 
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts
{
    function widget($args, $instance)
    {
        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }
        $title = (!empty($instance['title'])) ? $instance['title'] : __('Recent Posts');
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        if (!$number)
            $number = 5;
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
        /**
         * Filter the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        )));
        if ($r->have_posts()) :
?>
            <?php echo $args['before_widget']; ?>
            <?php if ($title) {
                echo $args['before_title'] . $title . $args['after_title'];
            } ?>
            <?php while ($r->have_posts()) : $r->the_post(); ?>
                <div class="post-item">
                    <?php the_post_thumbnail(); ?>
                    <div class="post-content">
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php get_the_title() ? the_title() : the_ID(); ?></h3>
                        </a>
                        <?php if ($show_date) : ?>
                            <p><?php echo get_the_date(); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php echo $args['after_widget']; ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();
        endif;
    }
}
function my_recent_widget_registration()
{
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');