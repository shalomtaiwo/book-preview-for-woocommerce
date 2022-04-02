<?php
if ( ! defined( 'WPINC' ) ) {die;} // end if
?>

<div id="wbps_simple_popup" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="textModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <div id="textModalLabel" class="modal-title">
                    <?php
                    $wbps_string = $product->get_title();
                    // Trimming length of string
                    $new_wbps_string = mb_strimwidth($wbps_string, 0, 110, "...");
                    echo esc_html($new_wbps_string); ?>
                </div>
                <button type="button" class="btn-close close_button_pdf" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($wbps_preview_woocommerce_content)) {
                    echo html_entity_decode($wbps_preview_woocommerce_content);
                }else{
                    echo esc_html("Preview content for this product is currently empty. Add some content!");
                } ?>
            </div>
            <div class="modal-footer">
                <div><b>Published: </b> <?php if (!empty(esc_html($wbps_preview_woo_year))) {
                        echo esc_html($wbps_preview_woo_year);
                    } ?></div>
                <div><b>Author: </b> <?php if (!empty(esc_html($wbps_preview_woo_author))) {
                        echo esc_html($wbps_preview_woo_author);
                    } ?></div>
            </div>
        </div>
</div>
</div>