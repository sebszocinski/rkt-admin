<?php

/*
Plugin Name: Rockethouse WordPress Admin UI
Plugin URI: http://www.rockethouse.com.au
Description: Rockethouse WordPress Admin UI Theme - Upload and Activate.
Author: Rockethouse
Version: 3.2.4
Author URI: http://www.rockethouse.com.au
GitHub Plugin URI: https://github.com/rockethouse/rkt-admin
GitHub Branch: master
*/


add_action('admin_head', 'site_name_meta');

function site_name_meta() {
    echo '<meta name="site_name" content="' . get_bloginfo('name') . '">';
}

add_action( 'login_enqueue_scripts', 'custom_login_enqueue_scripts' );
function custom_login_enqueue_scripts()
{
    wp_enqueue_script('jquery');
}

function login_classes( $classes ) {
    $classes[] = 'rkt';
    return $classes;
}
add_filter( 'login_body_class', 'login_classes' );

add_filter( 'admin_body_class', 'rw_admin_body_class' );
function rw_admin_body_class( $classes )
{
    $classes .= '' . 'rkt';
    return $classes;
}

function my_admin_theme_style() {
    wp_enqueue_style('roboto', '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic');
    wp_enqueue_style('default-admin', plugins_url('css/rkt-admin.css', __FILE__));
    wp_enqueue_script('adminjs', plugins_url('js/admin.js', __FILE__));
}

add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');



add_filter( 'mce_css', 'filter_mce_css' );

function filter_mce_css( $mce_css ) {

    $mce_css .= ', ' . plugins_url( 'css/rkt-editor-style.css', __FILE__ );

    return $mce_css;
}


add_action( 'admin_menu', 'admin_remove_menu_pages' );

function admin_remove_menu_pages() {
    defined('RKT_SHOW_COMMENTS') or remove_menu_page('edit-comments.php');
    defined('RKT_SHOW_POSTS') or remove_menu_page('edit.php');
}

add_action( 'admin_menu', 'manager_remove_menu_pages', 9999 );

function manager_remove_menu_pages() {

    $user_id = get_current_user_id();
    if ($user_id != 1) { // Add Admin User ID's here
        defined('RKT_SHOW_COMMENTS') or remove_menu_page('edit-comments.php');
        defined('RKT_SHOW_POSTS') or remove_menu_page('edit.php');
        defined('RKT_SHOW_PROFILE') or remove_menu_page('profile.php');
        defined('RKT_SHOW_PLUGINS') or remove_menu_page('plugins.php');
        defined('RKT_SHOW_USERS') or remove_menu_page('users.php');
        defined('RKT_SHOW_OPTIONS') or remove_menu_page('options-general.php');
        defined('RKT_SHOW_THEMES') or remove_menu_page('themes.php');
        defined('RKT_SHOW_TOOLS') or remove_menu_page('tools.php');
        defined('RKT_SHOW_ACFPRO') or remove_menu_page('edit.php?post_type=acf-field-group');
        defined('RKT_SHOW_ACF') or remove_menu_page('edit.php?post_type=acf');
        defined('RKT_SHOW_CPT') or remove_menu_page('cpt_main_menu');
        remove_menu_page('eml-taxonomies-options');
        remove_menu_page('wpa_dashboard');
    }
}

// REMOVE ADMIN COLUMNS FOR COMMENTS & AUTHORS
add_action( 'admin_init', 'remove_admin_columns' );
function remove_admin_columns() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
    remove_post_type_support( 'attachment', 'comments' );
    remove_post_type_support( 'post', 'author' );
    remove_post_type_support( 'page', 'author' );
}



// Remove Widgets
function remove_dashboard_meta() {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
        remove_meta_box( 'mandrill_widget', 'dashboard', 'normal');
}
add_action( 'admin_init', 'remove_dashboard_meta' );





// **** START Custom  Menu Link (Eg is for a Webletter)

//add_action( 'admin_menu', 'register_menu_page' );

// function register_menu_page(){
//     add_menu_page( __( 'Webletter', 'text_domain' ), __( 'Webletter', 'text_domain' ), 'manage_options', 'webletter', 'redirect_url', 6 );
// }

// function redirect_url() {
//     $redirect_url = get_bloginfo('url').'/wp-admin/admin.php?page=webletter';
//     $pageURL = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
//     $external_redirect_url = 'http://enews.rockethouse.com.au';

//     if ($pageURL == $redirect_url) {
//         // header ('location:' + $external_redirect_url);
//         wp_redirect( $external_redirect_url, 302 );
//     }
// }

// add_action( 'admin_menu', 'redirect_url' );

// **** END Custom External Menu Link


function add_grav_forms(){
    $role = get_role('editor');
    $role->add_cap('gform_full_access');
}
add_action('admin_menu','add_grav_forms');



add_filter('gettext', 'rename_admin_menu_items');
add_filter('ngettext', 'rename_admin_menu_items');

function rename_admin_menu_items( $menu ) {
    $menu = str_ireplace( 'WooCommerce', 'Store', $menu );
    $menu = str_ireplace( 'Loco Translate', 'Languages', $menu );
    return $menu;
}


function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
    $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


// add_action( 'admin_head', 'disable_admin_hoverintent' );

// function disable_admin_hoverintent() {
//     wp_enqueue_script(
//         // Script handle
//         'disable-admin-hoverintent',
//         // Script URL
//         array( 'admin-bar', 'common' )
//     );
// }


/* ------------------------------------ *\
 | RocketHouse Custom Admin Theme Menu
\* ------------------------------------ */

/*add_action('admin_menu', 'rha_theme_menu_init', 10);
function rha_theme_menu_init() {
    add_menu_page("RocketPanel", "RocketPanel", "administrator", "rha-settings", "rha_theme_menu", plugin_dir_url( __FILE__ ).'/images/rockethouse_logo.png', 3);
}

function rha_theme_menu() {
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    if (!user_can($user_id, 'create_users'))
        return false;
    ?>
    <div class="wrap">
        <h2>RocketPanel</h2>

    </div>



    <?
}*/
/* ------------------------------------ *\
 | End Custom Theme Menu
\* ------------------------------------ */


