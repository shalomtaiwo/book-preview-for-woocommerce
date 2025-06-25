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
				'desc' => __( '<p class="wbps_settings_info" style="color: black; background-color: #bfe7f5; padding: 10px;">Need to help? <span id="wbps_contact_section_sht" style="display: flex; flex-direction: row;"><button class="btn_wbps_Section" style="margin: 5px; background-color: black; color: white; padding: 5px; border: 0; border-radius: 5px; cursor: pointer;"><a href="https://reavdev.com/book-preview/contact" target="_blank" style="text-decoration:none; color:white;" class="btn_wbps_link">Get Help</a></button></span></p>', 'wpbpreview'),
				'id' => 'wbps_preview_front_settings'
			),

			'section_general_title' => array(
				'name' => __('General Settings', 'wpbpreview'),
				'type' => 'title',
				'desc' => __('Basic configuration for the Book Preview plugin.', 'wpbpreview'),
				'id' => 'wbps_section_general'
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
			'section_general_end' => array(
				'type' => 'sectionend',
				'id' => 'wbps_section_general_end'
			),

			'section_preview_title' => array(
				'name' => __('Preview Features', 'wpbpreview'),
				'type' => 'title',
				'desc' => __('Options for the preview popup.', 'wpbpreview'),
				'id' => 'wbps_section_preview'
			),
			'wbps_feature_fullscreen' => array(
				'name' => __( 'Enable Fullscreen Option', 'wpbpreview' ),
				'type' => 'checkbox',
				'desc' => __( 'Enable fullscreen option in book preview', 'wpbpreview' ),
				'id' => 'wbps_preview_feature_fullscreen',
				'default' => 'no',
			),
			'section_preview_end' => array(
				'type' => 'sectionend',
				'id' => 'wbps_section_preview_end'
			),

			'section_alert_title' => array(
				'name' => __('Purchase Alert (PDF Preview)', 'wpbpreview'),
				'type' => 'title',
				'desc' => __('Configure the alert shown at the end of PDF previews.', 'wpbpreview'),
				'id' => 'wbps_section_alert'
			),
			'wbps_enable_purchase_alert' => array(
				'name' => __( 'Enable Purchase Alert on Last Page', 'wpbpreview' ),
				'type' => 'checkbox',
				'desc' => __( 'Only works for PDF previews', 'wpbpreview' ),
				'id' => 'wbps_enable_purchase_alert',
				'default' => 'no',
			),
			'wbps_purchase_alert_title' => array(
				'name' => __( 'Purchase Alert Title', 'wpbpreview' ),
				'type' => 'text',
				'desc' => __( 'Title for the purchase alert (shown on last page of PDF preview)', 'wpbpreview' ),
				'id' => 'wbps_purchase_alert_title',
				'default' => 'Preview ended',
			),
			'wbps_purchase_alert_content' => array(
				'name' => __( 'Purchase Alert Content', 'wpbpreview' ),
				'type' => 'textarea',
				'desc' => __( 'Content for the purchase alert (shown on last page of PDF preview)', 'wpbpreview' ),
				'id' => 'wbps_purchase_alert_content',
				'default' => 'You have reached the end of the preview. Purchase now!',
			),
			'wbps_purchase_button_text' => array(
				'name' => __( 'Purchase Button Text', 'wpbpreview' ),
				'type' => 'text',
				'desc' => __( 'Text for the purchase button', 'wpbpreview' ),
				'id' => 'wbps_purchase_button_text',
				'default' => 'Purchase Now',
			),
			'wbps_purchase_button_action' => array(
				'name' => __( 'Purchase Button Action', 'wpbpreview' ),
				'type' => 'select',
				'desc' => __( 'Choose what happens when the purchase button is clicked', 'wpbpreview' ),
				'id' => 'wbps_purchase_button_action',
				'options' => array(
					'add_to_cart' => __( 'Add to Cart', 'wpbpreview' ),
					'custom_link' => __( 'Custom Link', 'wpbpreview' ),
				),
				'default' => 'add_to_cart',
			),
			'wbps_purchase_button_link' => array(
				'name' => __( 'Custom Purchase Link', 'wpbpreview' ),
				'type' => 'text',
				'desc' => __( 'If using custom link, enter the URL to redirect to when the button is clicked.', 'wpbpreview' ),
				'id' => 'wbps_purchase_button_link',
				'default' => '',
			),
			'section_alert_end' => array(
				'type' => 'sectionend',
				'id' => 'wbps_section_alert_end'
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