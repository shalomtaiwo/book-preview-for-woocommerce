<?php
if (!defined('WPINC')){die;} // end if
//call preview code and add preferred template.
// Define Our Constants
?>
<!-- wbps_preview_overlay -->
<div id="wbps_show_current_preview_pdf" class="wbps_preview_overlay" style="display: none;">
    <!-- wbps_preview_popup_pdf -->
    <div
        class="wbps_title_flex_container"
        id="wbps_overlay_closep"
        style="background-color:<?php echo esc_attr(get_option('wbps_preview_close_settings_background_color')) ?>"
        ;=";">
        <button
            id="wbps_close_button_position_p" style="background-color:<?php echo esc_attr(get_option('wbps_preview_close_settings_background_color')) ?>;
            color:<?php echo esc_attr(get_option('wbps_preview_close_settings_text_color')) ?>" onclick="popupClosep();">Close <span style="color:<?php echo esc_attr(get_option('wbps_preview_close_settings_background_color')) ?>; 
        background-color:<?php echo esc_attr(get_option("wbps_preview_close_settings_text_color")) ?>; padding: 0 4px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;padding: 0 4px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;" class="wbps_close_word_icon">X</span></button>
    </div>
    <div class="wbps_preview_popup_pdf_inner" id="wbps_preview_popup_pdf_inner">
        <div class="wbps_preview_popup_pdf" id="wbps_preview_popup_pdf">
            <div id="wbps_preview_popup_pdf-inner" class="wbps_preview_popup_pdf-inner">
                <!-- Add PDF PREVIEW CONTENT -->
                <div style="height:100%; width: 100%; top:0;">
                    <object
                        class="wbps_pdf_output"
                        style="min-height:100vh;width:100%;"
                        type="application/pdf"
                        data="<?php echo esc_url($wbps_preview_pdf_link) ?>?#scrollbar=0&toolbar=0&navpanes=0">
                        <iframe
                            src="<?php echo esc_url($wbps_preview_pdf_link) ?>?#scrollbar=0&toolbar=0&navpanes=0"
                            frameborder="0"
                            style="min-height:100vh;width:100%;">
                            <embed
                                src="<?php echo esc_url($wbps_preview_pdf_link) ?>?#scrollbar=0&toolbar=0&navpanes=0"
                                style="min-height:100vh;width:100%;"></embed>
                            <div>
                                <?php echo html_entity_decode($wbps_preview_pdf_browser_preview)?>
                            </div>
                        </iframe>
                    </object>
                </div>
                <div>
                    <div id="wbps_preview_popup_footer_text">
                        <h4 id="wbps_sample_buy">Enjoying this sample?
                        </h4>
                        <p>Buy the book to continue reading
                        </p>
                    </div>
                    <div class="wbps_bottom_preview_inner" id="wbps_bottom_preview_inner">
                        <div class="wbps_bottom_mask">
                            <div class="wbps_pre_add_to_cart">
                                <?php

global $product;
$product = wc_get_product(get_the_ID());
if ($product->is_type('simple'))
{
?>
                                <a href="<?php echo esc_url($product->add_to_cart_url()) ?>">
                                    <button
                                        class='wbps_simple_add_to_cart' style="background-color:<?php echo esc_attr(get_option('wbps_preview_close_settings_background_color')) ?>;color:<?php echo esc_attr(get_option('wbps_preview_close_settings_text_color')) ?>">add to cart</button>
                                </a>
                            <?php
}
else
{ ?>
                                <button
                                    id="wbps_close_sticky_position_r"
                                    style="background-color:<?php echo esc_attr(get_option('wbps_preview_close_settings_background_color')) ?>;color:<?php echo esc_attr(get_option('wbps_preview_close_settings_text_color')) ?>"
                                    onclick="popupClosep();">View Options
                                </button>
                                <?php
}
?>
                            </div>
                            <div class="wbps_preview_copyright">Copyright ©
                                <?php echo esc_html(($wbps_preview_woo_year)) ?>
                                All rights reserved. No portion of this book may be reproduced in any form
                                without permission from the publisher
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wbps_small_preview_inner" id="wbps_small_preview_inne">
            <div class="wbps_mask">
                <div class="wbps_colleft">
                    <div class="wbps_col1">
                        <p class="wbps_preview_author_settings">
                            <b>
                                <?php echo esc_html(($wbps_preview_woo_author)) ?>
                            </b>
                        </p>
                        <p class="wbps_preview_title_settings">
                            <?php
$wbps_string = $product->get_title();
// Trimming length of string
$new_wbps_string = mb_strimwidth($wbps_string, 0, 110, "...");
echo esc_html($new_wbps_string); ?>
<br>
<?php
if ($product->is_type('simple'))
{
    $wbps_price_p = $product->get_price();
    echo esc_html(get_woocommerce_currency_symbol());
    echo esc_html($wbps_price_p);
}
elseif ($product->is_type('variable'))
{
    $wb_regular_price = $product->get_variation_regular_price('min', true);
    $wb_regular_max_price = $product->get_variation_regular_price('max', true);
    $wb_sale_min_price = $product->get_variation_sale_price('min', true);
    $wb_sale_max_price = $product->get_variation_sale_price('max', true);
    if ($product->is_on_sale('variable'))
    {
        echo esc_html(get_woocommerce_currency_symbol());
        echo esc_html($wb_sale_min_price); ?>
                        -
                    <?php echo esc_html($wb_sale_max_price);
    }
    else
    {
        echo esc_html(get_woocommerce_currency_symbol());
        echo esc_html($wb_regular_price); ?>
                        -
                    <?php echo esc_html($wb_regular_max_price);
    }
}
else
{
    //nothing
    
}
?>
                    </div>
                    <div class="wbps_col2">
                        <?php echo $product->get_image();?>
                    </div>
                </div>
            </div>
            <div class="wbps_pre_add_to_cart">
                <?php
global $product;
$product = wc_get_product(get_the_ID());
if ($product->is_type('simple'))
{
?>
                <a href="<?php echo esc_url($product->add_to_cart_url()) ?>">
                    <button style="background-color:<?php echo esc_attr(get_option('wbps_preview_close_settings_background_color')) ?>;color:<?php echo esc_attr(get_option('wbps_preview_close_settings_text_color')) ?>" class='wbps_simple_add_to_cart'>Add to cart
                    </button>
                </a>
            <?php
}
else
{ ?>
                <button
                    id="wbps_close_sticky_position"
                    style="background-color:<?php echo esc_attr(get_option('wbps_preview_close_settings_background_color')) ?>;color:<?php echo esc_attr(get_option('wbps_preview_close_settings_text_color')) ?>"
                    onclick="popupClosep(); ">View Options
                </button>
                <?php
}
?>
            </div>
            <div class="wbps_preview_copyright">Copyright ©
                <?php echo esc_html(($wbps_preview_woo_year)) ?>
                All rights reserved. No portion of this book may be reproduced in any form
                without permission from the publisher
            </div>
        </div>
    </div>
</div>