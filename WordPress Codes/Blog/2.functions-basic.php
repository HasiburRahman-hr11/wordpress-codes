<?php

// WP theme support

function adding_theme_support()
{
    load_theme_textdomain('portfolio', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');


    $logo_width  = 60;
    $logo_height = 60;

    add_theme_support(
        'custom-logo',
        array(
            'height'               => $logo_height,
            'width'                => $logo_width,
            'flex-width'           => true,
            'flex-height'          => true,
            'unlink-homepage-logo' => true,
        )
    );

    // Menu Registering
    register_nav_menus(
        array(
            'main_manu' => esc_html__('Main menu', 'portfolio'),
            'mobile_manu'  => __('Mobile menu', 'portfolio'),
        )
    );

    add_theme_support(
        'html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        )
    );
}
add_action('after_setup_theme', 'adding_theme_support');

// Style and Scrtipts Enqueue

function adding_theme_scripts()
{
    // Fontawesome
    wp_enqueue_style('Fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
    // Main
    wp_enqueue_style('portfolio-main', get_template_directory_uri() . '/css/style.css', array(), wp_get_theme()->get('Version'));

    /* ---- Java Script Files ---- */
    wp_enqueue_script('jquery');
    wp_register_script('main-js', get_theme_file_uri('/js/main.js'), array('jquery'), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('main-js');
}
add_action('wp_enqueue_scripts', 'adding_theme_scripts');

// Widgets Initialisation
function widgets_initialisation()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Blog Sidebar', 'portfolio'),
            'id'            => 'blog-sidebar',
            'description'   => esc_html__('Add widgets here to appear in your blog page.', 'portfolio'),
            'before_widget' => '<aside class="single-sidebar-widget">',
            'after_widget'  => '</div></aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4><div class="widget-body">',
        )
    );
}
add_action('widgets_init', 'widgets_initialisation');