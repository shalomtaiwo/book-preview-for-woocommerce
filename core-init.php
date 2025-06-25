<?php
/*
 *
 *	***** Woocommerce Book preview *****
 *
 *	This file initializes all WBPS Core components
 *	
 */
// If this file is called directly, abort. //
if (!defined('WPINC')) {
    die;
} // end if
// Define Our Constants
define('WBPS_CORE_CSS', plugins_url('assets/css/', __FILE__));
define('WBPS_CORE_JS', plugins_url('assets/js/', __FILE__));


/*
 *
 *  Register CSS
 *
 */
function wbps_register_core_css()
{
    wp_enqueue_style('wbps-style', WBPS_CORE_CSS . 'wbps-style.css', null, time(), 'all');
}
;
add_action('wp_enqueue_scripts', 'wbps_register_core_css');
/*
 *
 *  Register JS/Jquery Ready
 *
 */
function wbps_register_core_js()
{
    // Register Core Plugin JS	
    wp_enqueue_script('wbps-script', WBPS_CORE_JS . 'wbps-script.js', 'jquery', time(), true);
}
;
add_action('wp_enqueue_scripts', 'wbps_register_core_js');
/*
 *
 *  Includes
 *
 */
// Load the Functions
include plugin_dir_path(__FILE__) . 'includes/settings/wbps-core-functions.php';

/*
 *
 *   Language
 *
 */
add_action('plugins_loaded', 'wpbpreview_load_textdomain');

function wpbpreview_load_textdomain()
{
    load_plugin_textdomain('wpbpreview', false, dirname(plugin_basename(__FILE__)) . '/languages');
}