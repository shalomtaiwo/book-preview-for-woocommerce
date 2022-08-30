<?php
if ( ! defined( 'WPINC' ) ) {die;} // end if

include plugin_dir_path(__FILE__) . 'wbps-woo-core-settings.php';
include plugin_dir_path(__FILE__) . '../admin/wbps-core-admin.php';

// SET PRODUCT TYPES
add_action('woocommerce_product_data_tabs', 'add_wbps_preview_link_tab');
add_action('woocommerce_product_data_panels', 'show_wbps_access_link_tab_content');

function add_wbps_preview_link_tab($tabs)
{
    $tabs['wbps_woo'] = array(
        'label' => __('Book Preview', 'wbps') ,
        'class' => array(
            'show_if_simple',
            'show_if_variable',
            'show_if_grouped',
            'show_if_external'
        ) ,
        'target' => 'wbps_woo_options',
        'priority' => 65,
    );
    return $tabs;
}

function show_wbps_access_link_tab_content()
{
    global $woocommerce, $post;

    include plugin_dir_path(__FILE__) . '../admin/wbps-woo-core-options.php';

}
//Save after Updating Product
add_action('woocommerce_process_product_meta_simple', 'wbps_save_options');
add_action('woocommerce_process_product_meta_variable', 'wbps_save_options');
add_action('woocommerce_process_product_meta_grouped', 'wbps_save_options');
add_action('woocommerce_process_product_meta_external', 'wbps_save_options');
function wbps_save_options($product_id)
{
    $wbps_txt_keys = array(
        'wbps_preview_content_author',
        'wbps_preview_year_publication',
        'wbps_preview_select_option',
        'wbps-preview-pdf-content',
    );
    $wbps_txtarea_keys = array(
        'wbps-preview-text-content',
        'wbps-preview-pdf-content-alt'
    );

    foreach ($wbps_txt_keys as $wbps_txt_key)
    {
        if (isset($_POST[$wbps_txt_key]))
        {
            update_post_meta($product_id, $wbps_txt_key, sanitize_text_field( $_POST[$wbps_txt_key] )); // phpcs:ignore
            
        }
    }
    foreach ($wbps_txtarea_keys as $wbps_txtarea_key)
    {
        if (isset($_POST[$wbps_txtarea_key]))
        { 
            update_post_meta($product_id, $wbps_txtarea_key, html_entity_decode(sanitize_textarea_field(htmlentities($_POST[$wbps_txtarea_key] )))); // phpcs:ignore
            
        }
    }
}
function woocommerce_wbps_button_display()
{
    $wbps_popup_template = get_option('wbps_popup_front_selection');

    if ($wbps_popup_template == 'wbps_simple_template')
    {
        wbps_user_preview_simple();
    }
}

// Create Shortcode book_preview
// Shortcode: [book_preview id=""]
function create_book_preview_shortcode($atts) {
    // Attributes
    $atts = shortcode_atts(
        array(
            'id' => '',

        ),
        $atts,
        'book_preview'
    );
    // Attributes in var
    $id = $atts['id'];

    global $product;
    $product = wc_get_product( $id );
    $wbps_preview_woocommerce_content = $product->get_meta('wbps-preview-text-content');
    $wbps_preview_woo_author = $product->get_meta('wbps_preview_content_author');
    $wbps_preview_woo_year = $product->get_meta('wbps_preview_year_publication');
    $wbps_preview_pdf_link = $product->get_meta('wbps-preview-pdf-content');
    $wbps_preview_pdf_browser_preview = $product->get_meta('wbps-preview-pdf-content-alt');
    $empty_value_opt = $product->get_meta('wbps_preview_select_option');

    ob_start();

            if ($empty_value_opt == 'wbps_txteditor')
        {
            front_wbps_button_simple($id);
            include (plugin_dir_path(__FILE__) . '../template/simple/wbps-simple-editor-template.php');
        }
        elseif ($empty_value_opt == 'wbps_opt_pdf')
        {
            front_wbps_button_simple_pdf($id);
            include (plugin_dir_path(__FILE__) . '../template/simple/wbps-simple-editor-template-pdf.php');
        }


    return ob_get_clean();
    
    }
    
add_shortcode( 'book_preview', 'create_book_preview_shortcode' );


add_action('woocommerce_before_add_to_cart_form', 'woocommerce_wbps_button_display');

function wbps_user_preview_simple(){
    global $post;
    $product = wc_get_product($post->ID);
    $wbps_preview_woocommerce_content = $product->get_meta('wbps-preview-text-content');
    $wbps_preview_woo_author = $product->get_meta('wbps_preview_content_author');
    $wbps_preview_woo_year = $product->get_meta('wbps_preview_year_publication');
    $wbps_preview_pdf_link = $product->get_meta('wbps-preview-pdf-content');
    $wbps_preview_pdf_browser_preview = $product->get_meta('wbps-preview-pdf-content-alt');
    $empty_value_opt = $product->get_meta('wbps_preview_select_option');
    if (is_product()){
    if ($empty_value_opt == 'wbps_txteditor')
    {
        front_wbps_button_simple($product -> get_id());
        include (plugin_dir_path(__FILE__) . '../template/simple/wbps-simple-editor-template.php');
    }
    elseif ($empty_value_opt == 'wbps_opt_pdf')
    {
        front_wbps_button_simple_pdf($product -> get_id());
        include (plugin_dir_path(__FILE__) . '../template/simple/wbps-simple-editor-template-pdf.php');
    }
    else
    {
?>
<style>
.wbps_popup_btn,
#wbps_fa,
#wbps_fas {
    display: none;
}
</style>
<?php
}
    }
}

function front_wbps_button_simple($id)
{
?><button style="background-color:<?php echo esc_attr(get_option("wbps_preview_front_settings_background_color")) ?>;
color:<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>; width: fit-content;"
    id="wbps_popup_btnsimple <?php echo $id ?>"
    class="wbps_popup_btn cursor-pointer mb-2 px-1 py-2 px-1 rounded border-0" data-bs-toggle="modal"
    data-bs-target="#wbps_<?php echo $id ?>">
    <span><?php echo esc_html(get_option("wbps_preview_front_settings_title"))?></span><svg width="25px"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 250">
        <rect width="25" height="25" fill="none" />
        <path class="show_wbps_icon_fill"
            fill="<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>"
            stroke="<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="8"
            d="M228.14833,121.17381,84.1717,33.18517A8,8,0,0,0,72,40.01136V215.98864a8,8,0,0,0,12.1717,6.82619l143.97663-87.98864A8,8,0,0,0,228.14833,121.17381Z" />
    </svg>
</button>
<script type="text/javascript">
var wpbp_txt_input = document.getElementById('wbps_popup_btnsimple');
if (wpbp_txt_input.value.length === 0)
    wpbp_txt_input.value = "Preview";
</script>
<?php
}

function front_wbps_button_simple_pdf($id)
{
?>
<button style="background-color:<?php echo esc_attr(get_option("wbps_preview_front_settings_background_color")) ?>;
color:<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>; width: fit-content;"
    id="wbps_popup_btnsimple_pdf <?php echo $id ?>"
    class="wbps_popup_btn cursor-pointer mb-2 px-1 py-2 px-1 rounded border-0" data-bs-toggle="modal"
    data-bs-target="#wbps_<?php echo $id ?>">
    <span><?php echo esc_html(get_option("wbps_preview_front_settings_title"))?> </span>
    <svg width="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 250">
        <rect width="25" height="25" fill="none" />
        <path class="show_wbps_icon_fill"
            fill="<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>"
            stroke="<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="8"
            d="M228.14833,121.17381,84.1717,33.18517A8,8,0,0,0,72,40.01136V215.98864a8,8,0,0,0,12.1717,6.82619l143.97663-87.98864A8,8,0,0,0,228.14833,121.17381Z" />
    </svg>
</button>
<script type="text/javascript">
var wpbp_txt_input = document.getElementById('wbps_popup_btnsimple_pdf');
if (wpbp_txt_input.value.length === 0)
    wpbp_txt_input.value = "Preview";
</script>
<?php
}