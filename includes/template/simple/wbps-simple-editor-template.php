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
                    <div class="collapse-container" style="margin: 0; display: flex; align-items: center; gap: 5px;">
                    <?php if (get_option('wbps_preview_feature_fullscreen') === 'yes'): ?>
                        <button class="wbps-button" id="wbps-fullscreenBtn"
                            style="background-color: <?php echo esc_attr(get_option("wbps_preview_front_settings_background_color")) ?>; border: 1.5px solid <?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; margin-right: 4px;"
                            title="Fullscreen">
                            <span id="wbps-fullscreen-icon" style="display: inline;">
                                <!-- Maximize SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-maximize"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 4l4 0l0 4" /><path d="M14 10l6 -6" /><path d="M8 20l-4 0l0 -4" /><path d="M4 20l6 -6" /><path d="M16 20l4 0l0 -4" /><path d="M14 14l6 6" /><path d="M8 4l-4 0l0 4" /><path d="M4 4l6 6" /></svg>
                            </span>
                            <span id="wbps-resize-icon" style="display: none;">
                                <!-- Minimize SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-minimize"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 9l4 0l0 -4" /><path d="M3 3l6 6" /><path d="M5 15l4 0l0 4" /><path d="M3 21l6 -6" /><path d="M19 9l-4 0l0 -4" /><path d="M15 9l6 -6" /><path d="M19 15l-4 0l0 4" /><path d="M15 15l6 6" /></svg>
                            </span>
                        </button>
                    <?php endif; ?>
                        <button class="wbps-collapse-button wbps-collapse-button-text wbps-button" id="wbps-collapseBtn"
                            style="background-color: <?php echo esc_attr(get_option("wbps_preview_front_settings_background_color")) ?>; border: 1.5px solid <?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;"
                            title="About">
                            <!-- About SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 20 20" fill="none" stroke="<?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-notebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" /><path d="M13 8l2 0" /><path d="M13 12l2 0" /></svg>
                        </button>
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
                        <svg viewBox="0 0 18 18">
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