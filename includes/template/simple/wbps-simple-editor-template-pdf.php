<?php
if ( ! defined( 'WPINC' ) ) {die;} // end if
?>

<div id="wbps_simple_popup_pdf" class="wbps_simple_popup" style="display:none;">
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
                <div class="wbps_mycontent_close_pdf" onclick="popupClosesimplep()">
                <span class="wbps_close_word_icon">X</span>
                </div>
            </div>
            <div class="wbps_popup_main_content">
            <div id="wbps-no-click"> 
            <div style="height:inherit; width: 100%; top:0;">
                    <object
                        class="wbps_pdf_output"
                        style="min-height:88vh;width:100%;"
                        type="application/pdf"
                        data="<?php echo esc_url($wbps_preview_pdf_link) ?>?#scrollbar=0&toolbar=0&navpanes=0">
                        <iframe
                            src="<?php echo esc_url($wbps_preview_pdf_link) ?>?#scrollbar=0&toolbar=0&navpanes=0"
                            frameborder="0"
                            style="min-height:88vh;width:100%;">
                            <embed
                                src="<?php echo esc_url($wbps_preview_pdf_link) ?>?#scrollbar=0&toolbar=0&navpanes=0"
                                style="min-height:88vh;width:100%;"></embed>
                            <div>
                                <?php echo html_entity_decode($wbps_preview_pdf_browser_preview)?>
                            </div>
                        </iframe>
                    </object>
                </div>            </div>
            </div>
        </div>
</div>
</div>