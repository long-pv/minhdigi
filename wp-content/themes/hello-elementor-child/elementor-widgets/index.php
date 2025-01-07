<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

function register_custom_widgets($widgets_manager)
{

    // include file
    require_once TEMPLATE_PATH . 'duplicate_widget.php';
    require_once TEMPLATE_PATH . 'archive_posts.php';
    require_once TEMPLATE_PATH . 'breadcrumb.php';
    require_once TEMPLATE_PATH . 'post_info.php';
    require_once TEMPLATE_PATH . 'profile_card.php';
    require_once TEMPLATE_PATH . 'related_news.php';
    require_once TEMPLATE_PATH . 'related_post.php';
    require_once TEMPLATE_PATH . 'author_post.php';
    // post_info profile_card related_news author_post


    // Register widgets
    $widgets_manager->register(new \Duplicate_Widget());
    $widgets_manager->register(new \Archive_Posts_Widget());
    // Vucoder 
    $widgets_manager->register(new \Breadcrumb_Widget());
    $widgets_manager->register(new \Post_Info_Widget());
    $widgets_manager->register(new \Profile_Card_Widget());
    $widgets_manager->register(new \Related_News_Widget());
    $widgets_manager->register(new \Related_Post_Widget());
    $widgets_manager->register(new \Author_Post_Widget());
}
add_action('elementor/widgets/register', 'register_custom_widgets');

function register_custom_widget_category($elements_manager)
{
    $elements_manager->add_category(
        'custom_widgets_theme',
        [
            'title' => __('Custom Widgets', 'child_theme'),
            'priority' => 0,
        ]
    );

    $elements_manager->add_category(
        'custom_builder_theme',
        [
            'title' => __('Custom Builder', 'child_theme'),
            'priority' => 1,
        ]
    );
}
add_action('elementor/elements/categories_registered', 'register_custom_widget_category');
