<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
$wbps_option_name = 'wbps_preview_front_settings_title';
$wbps_option_name1 = 'wbps_preview_front_settings_background_color';
$wbps_option_name2 = 'wbps_preview_front_settings_text_color';
$wbps_option_name3 = 'wbps_preview_close_settings_background_color';
$wbps_option_name4 = 'wbps_preview_close_settings_text_color';
$wbps_option_name5 = 'wbps_popup_front_selection';
 
delete_option($wbps_option_name);
delete_option($wbps_option_name1);
delete_option($wbps_option_name2);
delete_option($wbps_option_name3);
delete_option($wbps_option_name4);
delete_option($wbps_option_name5);