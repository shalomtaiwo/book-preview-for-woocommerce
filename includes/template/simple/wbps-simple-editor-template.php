<?php
if (!defined('WPINC')) {
    die;
} // end if
?>

<!-- wbps-modal -->
<div class="wbps-modal-overlay" id="wbps_<?php echo $product->get_id(); ?>" aria-labelledby="textModalLabel">
    <div class="wbps-modal">
        <!-- close wbps-modal -->

        <div class="wbps-modal-content">
            <div class="wbps-modal-header" dir="ltr">
                <div id="textModalLabel" class="wbps-modal-title" style="font-size: 18px; font-weight: 500;">
                    <?php
                    $wbps_string = $product->get_title();
// Trimming length of string
$new_wbps_string = mb_strimwidth($wbps_string, 0, 20, "...");
echo esc_html($new_wbps_string); ?>
                </div>
                <div class="wbps-modal-nav">
                    <div class="collapse-container">
                        <button class="wbps-collapse-button wbps-collapse-button-text wbps-button" id="wbps-collapseBtn"
                            style="background-color:<?php echo esc_attr(get_option("wbps_preview_front_settings_background_color")) ?>;
        color:<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>; font-size: 13px;">About</button>
                        <div class="wbps-collapse-content-text" id="wbps-collapseContent">
                            <!-- Content you want to collapse/expand -->
                            <div class="wbps-card">
                                <div><b>Published: </b>
                                    <?php if (!empty(esc_html($wbps_preview_woo_year))) {
                                        echo esc_html($wbps_preview_woo_year);
                                    } ?>
                                </div>
                                <div><b>Author: </b>
                                    <?php if (!empty(esc_html($wbps_preview_woo_author))) {
                                        echo esc_html($wbps_preview_woo_author);
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="close-wbps-modal">
                        <svg viewBox="0 0 20 20">
                            <path fill="#000000"
                                d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="wbps-modal-body-text">
                <?php
                if (!empty($wbps_preview_woocommerce_content)) {
                    echo html_entity_decode($wbps_preview_woocommerce_content);
                } else {
                    echo esc_html("Preview content for this product is currently empty. Add some content!");
                }
?>
            </div>
        </div>

    </div><!-- wbps-modal -->
</div><!-- overlay -->