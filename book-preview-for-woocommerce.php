<?php 
/*
Plugin Name: Book Preview for WooCommerce
Plugin URI: https://shalomt.com/plugins/wpbookpreview
Description: With Book Preview, show your customers a PDF or text-based preview of your books to increase your conversion rate and get more sales while selling with woocommerce
Requires at least: 5.8.2
Requires PHP: 5.7
Version: 1.0
Author: Shalomt
Author URI: https://shalomt.com/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wpbpreview
*/

// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if

// Let's Initialize Everything
$all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
if (stripos(implode($all_plugins), 'woocommerce.php')) {
    if ( file_exists( plugin_dir_path( __FILE__ ) . 'core-init.php' ) ) {
        require_once( plugin_dir_path( __FILE__ ) . 'core-init.php' );
        }
    }


register_uninstall_hook(__FILE__, 'WBPS_UNINSTALL_PLUGIN');

register_activation_hook(__FILE__, function(){
            activate_plugin('book-preview-for-woocommerce.php');
}); 

// When this plugin deactivate, deactivate another plugin too.
register_deactivation_hook(__FILE__, function(){
            deactivate_plugins('book-preview-for-woocommerce.php');
}); 