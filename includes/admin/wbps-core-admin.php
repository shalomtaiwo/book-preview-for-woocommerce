<?php
if ( ! defined( 'WPINC' ) ) {die;} // end if

function wbps_register_book_preview_page() {
        $page_title = 'Preview Settings';   
        $menu_title = 'Book Preview';   
        $capability = 'manage_options';   
        $menu_slug  = 'admin.php?page=wc-settings&tab=wbps_settings_woo_book_preview';   
        $function   = '';   
        $icon_url   = 'dashicons-book';   
        $position   = 25;
        add_menu_page($page_title, $menu_title, $capability,
        $menu_slug, $function ,$icon_url, $position
        );
}

add_action( 'admin_menu', 'wbps_register_book_preview_page' );