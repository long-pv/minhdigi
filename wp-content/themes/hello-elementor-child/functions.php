<?php
define('CHILD_URI', get_stylesheet_directory_uri());
define('CHILD_PATH', get_stylesheet_directory());
define('TEMPLATE_PATH', CHILD_PATH . '/elementor-widgets/template/');
if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.19');
}

// turn off auto update core wp
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);

/**
 * Enqueue scripts and styles.
 */
function child_theme_scripts()
{
    wp_enqueue_style('child_theme-style', CHILD_URI, array(), _S_VERSION);

    // normalize
    wp_enqueue_style('child_theme-style-normalize', CHILD_URI . '/assets/inc/normalize/normalize.css', array(), _S_VERSION);

    // bootstrap grid
    wp_enqueue_style('child_theme-style-grid', CHILD_URI . '/assets/inc/bootstrap/grid.css', array(), _S_VERSION);

    // matchHeight
    wp_enqueue_script('child_theme-script-matchHeight', CHILD_URI . '/assets/inc/matchHeight/jquery.matchHeight.js', array('jquery'), _S_VERSION, true);

    // toc plus
    wp_enqueue_script('child_theme-script-toc_plus', CHILD_URI . '/assets/js/jquery-stickyNavigator.js', array('jquery'), _S_VERSION, true);

    // add custom main css/js
    wp_enqueue_style('child_theme-style-main', CHILD_URI . '/assets/css/main.css', array(), _S_VERSION);
    wp_enqueue_script('child_theme-script-main', CHILD_URI . '/assets/js/main.js', array('jquery'), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'child_theme_scripts');

// Setup theme setting page
if (function_exists('acf_add_options_page')) {
    $name_option = 'Theme Settings';
    acf_add_options_page(
        array(
            'page_title' => $name_option,
            'menu_title' => $name_option,
            'menu_slug' => 'theme-settings',
            'capability' => 'edit_posts',
            'redirect' => false,
            'position' => 80
        )
    );
}

// auto active plugins
function activate_my_plugins()
{
    $plugins = [
        'advanced-custom-fields-pro\acf.php',
        'elementor\elementor.php',
    ];

    foreach ($plugins as $plugin) {
        $plugin_path = WP_PLUGIN_DIR . '/' . $plugin;

        if (file_exists($plugin_path) && !is_plugin_active($plugin)) {
            activate_plugin($plugin);
        }
    }
}
add_action('admin_init', 'activate_my_plugins');

// stop upgrading wp cerber plugin
add_filter('site_transient_update_plugins', 'disable_plugins_update');
function disable_plugins_update($value)
{
    // disable acf pro
    if (isset($value->response['advanced-custom-fields-pro/acf.php'])) {
        unset($value->response['advanced-custom-fields-pro/acf.php']);
    }
    if (isset($value->response['elementor/elementor.php'])) {
        unset($value->response['elementor/elementor.php']);
    }
    if (isset($value->response['elementor-pro/elementor-pro.php'])) {
        unset($value->response['elementor-pro/elementor-pro.php']);
    }
    return $value;
}

// include file function
require CHILD_PATH . '/inc/security.php';
require CHILD_PATH . '/inc/ajax.php';
require CHILD_PATH . '/inc/custom_theme.php';
// vudevelop.php
require CHILD_PATH . '/inc/vudevelop.php';
// cpt_custom
require CHILD_PATH . '/inc/cpt_custom.php';

// load widgets library
function load_custom_widgets()
{
    require CHILD_PATH . '/elementor-widgets/index.php';
}
add_action('elementor/init', 'load_custom_widgets');
