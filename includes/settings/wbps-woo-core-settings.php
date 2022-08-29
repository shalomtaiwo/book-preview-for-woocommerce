<?php if ( ! defined( 'WPINC' ) ) {die;} // end if

add_action( 'woocommerce_settings_tabs_array' , 'wbps_preview_add_settings_tab',50 );

function wbps_preview_add_settings_tab( $settings_tabs ){
     $settings_tabs['wbps_settings_woo_book_preview'] = __( 'Book Preview','wpbpreview' );
     return $settings_tabs;
}

add_action( 'woocommerce_settings_tabs_wbps_settings_woo_book_preview', 'wbps_settings_woo_book_preview');

function wbps_settings_woo_book_preview() {
    woocommerce_admin_fields(wbps_preview_front_settings_all_settings());
}

add_action('woocommerce_update_options_wbps_settings_woo_book_preview', 'update_wbps_settings_woo_book_preview');

function update_wbps_settings_woo_book_preview() {
    woocommerce_update_options(wbps_preview_front_settings_all_settings());
}
function wbps_preview_front_settings_all_settings() {
        $settings = array(
			'section_title' => array(
				'name' => __('Book Preview Settings', 'wpbpreview'),
				'type' => 'title',
				'desc' => __( '<p class="wbps_settings_info" style="color: black; background-color: #bfe7f5; padding: 10px;">Need to help? <span id="wbps_contact_section_sht" style="display: flex; flex-direction: row;"><button class="btn_wbps_Section" style="margin: 5px; background-color: black; color: white; padding: 5px; border: 0; border-radius: 5px; cursor: pointer;"><a href="https://shalomt.com/plugins/wpbookpreview/#faq" class="btn_wbps_link" style="text-decoration:none; color:white;" target="_blank">FAQ</a></button><button class="btn_wbps_Section" style="margin: 5px; background-color: black; color: white; padding: 5px; border: 0; border-radius: 5px; cursor: pointer;"><a href="https://shalomt.com/plugins/wpbookpreview/contact" target="_blank" style="text-decoration:none; color:white;" class="btn_wbps_link">Get Help</a></button><button class="btn_wbps_Section" style="margin: 5px; background-color: black; color: white; padding: 5px; border: 0; border-radius: 5px; cursor: pointer;"><a href="https://shalomt.com/plugins/wpbookpreview/contact" style="text-decoration:none; color:white;" target="_blank" class="btn_wbps_link">Feature Request</a></button></span></p>', 
				'wpbpreview'.'The following options are used to configure the Woocommerce Book Preview' ),
				'id' => 'wbps_preview_front_settings'
			),

			'wbps_template_style' => array(
				'name' => __('Choose Template', 'wpbpreview'),
				'type' => 'select',
				'desc_tip' => true,
				'placeholder' => 'Choose',
				'options'     => array(
					'wbps_simple_template' => __('Simple Popup', 'wpbpreview' ),
			  ),
				'desc' => __( 'Choose preferred popup template', 'wpbpreview' ),
				'id' => 'wbps_popup_front_selection'
			),
			'wbps_button_input' => array(
				'name' => __('Preview Button text', 'wpbpreview'),
				'type' => 'text',
				'desc_tip' => true,
				'placeholder' => 'Preview',
				'desc' => __( 'Change the button text according to your preference!', 'wpbpreview' ),
				'id' => 'wbps_preview_front_settings_title'
			),
			'wbps_button_bg' => array(
				'name'     => __( 'Button Background Color', 'wpbpreview' ),
				'id'       => 'wbps_preview_front_settings_background_color',
				'type'     => 'color',
				'placeholder' => 'e.g #ad2323',
				'desc'     => __( '', 'wpbpreview' )
			),
			'wbps_button_txt' => array(
				'name'     => __( 'Button Text Color', 'wpbpreview' ),
				'id'       => 'wbps_preview_front_settings_text_color',
				'type'     => 'color',
				'placeholder' => 'e.g #fcfcfc',
				'desc'     => __( '', 'wpbpreview' )
			),
        'section_end' => array(
            'type' => 'sectionend',
            'id' => 'wc_section_end'
        )
    );
	?>
<?php
    return apply_filters('wc_my_custom_tab_settings', $settings);
}
?>