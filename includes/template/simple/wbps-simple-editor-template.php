<?php
if ( ! defined( 'WPINC' ) ) {die;} // end if
?>

<div id="wbps_simple_popup" class="wbps_simple_popup" style="display:none;">
<div class="wbps_popup_simple_main">
        <div class="wbps_popup_box">
            <div class="wbps_popup_header">
                <div class="wbps_mycontent_title">
                    <?php
                    $wbps_string = $product->get_title();
                    // Trimming length of string
                    $new_wbps_string = mb_strimwidth($wbps_string, 0, 110, "...");
                    echo esc_html($new_wbps_string); ?>
                </div>
                <div class="wbps_mycontent_close" onclick="popupClosesimple()">
                <span class="wbps_close_word_icon">X</span>
                </div>
            </div>
            <div class="wbps_popup_main_content">
            <div id="wbps-no-click"> 
                <?php echo html_entity_decode($wbps_preview_woocommerce_content) ?>
            </div>
            </div>
        </div>
</div>
</div>