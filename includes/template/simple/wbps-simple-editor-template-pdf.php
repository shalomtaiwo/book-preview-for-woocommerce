<?php
if (!defined('WPINC')) {
    die;
} // end if
?>

<!-- wbps-modal -->
<div class="wbps-modal-overlay" id="wbps_<?php echo $product->get_id(); ?>" aria-labelledby="pdfModalLabel" dir="ltr">
    <div class="wbps-modal">
        <!-- close wbps-modal -->

        <div class="wbps-modal-content">
            <div class="wbps-modal-header">
                <div id="pdfModalLabel" class="wbps-modal-title" style="font-size: 18px; font-weight: 500;">
                    <?php
                    $wbps_string = $product->get_title();
                    // Trimming length of string
                    $new_wbps_string = mb_strimwidth($wbps_string, 0, 20, "...");
                    echo esc_html($new_wbps_string); ?>
                </div>
                <div class="wbps-modal-nav">
                    <nav class="nav">
                        <a class="wbps-button" id="wbpsPrev" style="cursor:pointer; color: black;">prev</a>
                        <a style="cursor:pointer; color: black;" class="wbps-button" id="wbpsNext">next</a>
                    </nav>
                    <a class="close-wbps-modal">
                        <svg viewBox="0 0 20 20">
                            <path fill="#000000"
                                d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="wbps-modal-body">

                <?php
                $show_purchase_alert = get_option('wbps_enable_purchase_alert', 'yes') === 'yes';
                $purchase_alert_title = get_option('wbps_purchase_alert_title', 'Preview ended');
                $purchase_alert_content = get_option('wbps_purchase_alert_content', 'You have reached the end of the preview. Purchase now!');
                $purchase_button_text = get_option('wbps_purchase_button_text', 'Purchase Now');
                $purchase_button_action = get_option('wbps_purchase_button_action', 'add_to_cart');
                $purchase_button_link = get_option('wbps_purchase_button_link', '');
                $product_id = $product ? $product->get_id() : 0;
                ?>
                <div id="wbpsAlert" role="alert" class="wbps-not-last-page">
                    <?php if ($show_purchase_alert): ?>
                        <div class="wbps-alert">
                        <div class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ffb300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><circle cx="12" cy="16" r="1"/></svg>
                        </div>
                        <div class="alert-content">
                            <h4><?php echo esc_html($purchase_alert_title); ?></h4>
                            <p><?php echo esc_html($purchase_alert_content); ?></p>
                            <?php if ($purchase_button_action === 'custom_link' && !empty($purchase_button_link)): ?>
                                <button class="modern-preview-end-btn" onclick="window.location.href='<?php echo esc_url($purchase_button_link); ?>'">
                                    <?php echo esc_html($purchase_button_text); ?>
                                </button>
                            <?php else: ?>
                                <button class="modern-preview-end-btn" id="wbpsAddToCartBtn" onclick="wbpsAddToCart(<?php echo esc_js($product_id); ?>)">
                                    <?php echo esc_html($purchase_button_text); ?>
                                </button>
                                <div id="wbpsAddToCartMsg" style="display:none; color: #388e3c; font-weight: 600; margin-top: 10px; text-align: center;">Added to cart!</div>
                                <script>
                                function wbpsAddToCart(productId) {
                                    if (!productId) return;
                                    var btn = document.getElementById('wbpsAddToCartBtn');
                                    var msg = document.getElementById('wbpsAddToCartMsg');
                                    btn.disabled = true;
                                    fetch('/?wc-ajax=add_to_cart', {
                                        method: 'POST',
                                        credentials: 'same-origin',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: 'product_id=' + encodeURIComponent(productId) + '&quantity=1'
                                    })
                                    .then(response => response.json())
                                    .then(function(response) {
                                        btn.disabled = false;
                                        if (msg) {
                                            msg.style.display = 'block';
                                        }
                                    });
                                }
                                </script>
                            <?php endif; ?>
                        </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                if ((!empty($wbps_preview_pdf_link))) {
                    try {
                        require_once plugin_dir_path(__FILE__) . 'pdfSettings/wbpsWooPdfViewer.php';
                    } catch (\Throwable $th) {
                        echo 'Error loading pdf';
                    }
                }
                ?>

            </div>
            <div class="wbps-modal-footer">
                <div class="pages text-center" style="margin: 10px;">
                    <span class="mr-2">Page </span>
                    <span id="wbpsCurrentPage">0</span>
                    <span class="mx-1">/</span>
                    <span id="wbpsTotalPages">0</span>
                </div>
                <div>
                <div class="collapse-container" style="margin: 0; display: flex; align-items: center; gap: 8px;">
                    <?php if (get_option('wbps_preview_feature_fullscreen') === 'yes'): ?>
                        <button class="wbps-button" id="wbps-fullscreenBtn"
                            style="background-color: white; border: 1.5px solid <?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px;"
                            title="Fullscreen">
                            <span id="wbps-fullscreen-icon" style="display: inline;">
                                <!-- Maximize SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-maximize"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 4l4 0l0 4" /><path d="M14 10l6 -6" /><path d="M8 20l-4 0l0 -4" /><path d="M4 20l6 -6" /><path d="M16 20l4 0l0 -4" /><path d="M14 14l6 6" /><path d="M8 4l-4 0l0 4" /><path d="M4 4l6 6" /></svg>
                            </span>
                            <span id="wbps-resize-icon" style="display: none;">
                                <!-- Minimize SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-minimize"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 9l4 0l0 -4" /><path d="M3 3l6 6" /><path d="M5 15l4 0l0 4" /><path d="M3 21l6 -6" /><path d="M19 9l-4 0l0 -4" /><path d="M15 9l6 -6" /><path d="M19 15l-4 0l0 4" /><path d="M15 15l6 6" /></svg>
                            </span>
                        </button>
                    <?php endif; ?>
                    <button class="collapse-button wbps-button" id="wbps-collapseBtn"
                        style="background-color: white; border: 1.5px solid <?php echo esc_attr(get_option("wbps_preview_front_settings_text_color")) ?>; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px;"
                        title="About">
                        <!-- About SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-notebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" /><path d="M13 8l2 0" /><path d="M13 12l2 0" /></svg>
                    </button>
                    <div class="wbps-collapse-content" id="wbps-collapseContent">
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
                </div>
            </div>
        </div>

    </div><!-- wbps-modal -->
</div><!-- overlay -->