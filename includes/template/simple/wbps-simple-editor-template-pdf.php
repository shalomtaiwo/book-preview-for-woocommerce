<?php
if ( ! defined( 'WPINC' ) ) {die;} // end if
?>

<div id="wbps_simple_popup_pdf" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
<div class="modal-dialog modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <div id="pdfModalLabel" class="modal-title">
                    <?php
                    $wbps_string = $product->get_title();
                    // Trimming length of string
                    $new_wbps_string = mb_strimwidth($wbps_string, 0, 110, "...");
                    echo esc_html($new_wbps_string); ?>
                </div>
                <button type="button" class="close_button_pdf btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
 if ((!empty($wbps_preview_pdf_link))) {
    ?>
<div style="height:inherit; width: 100%; top:0;">
    <object
        class="wbps_pdf_output"
        style="min-height:80vh;width:100%;"
        type="application/pdf"
        data="<?php echo esc_url($wbps_preview_pdf_link) ?>?#scrollbar=0&toolbar=0&navpanes=0">
        <iframe
            src="<?php echo esc_url($wbps_preview_pdf_link) ?>?#scrollbar=0&toolbar=0&navpanes=0"
            style="min-height:80vh;width:100%;">
            <div>
                <?php echo html_entity_decode($wbps_preview_pdf_browser_preview)?>
            </div>
        </iframe>
    </object>
</div>
<?php }
else{
        echo esc_html("PDF Link is Empty/Not valid");
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