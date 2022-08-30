<?php
if ( ! defined( 'WPINC' ) ) {die;} // end if
?>

<div id="wbps_<?php echo $product -> get_id(); ?>" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-between w-100">
                <div id="pdfModalLabel" class="modal-title">
                    <?php
                    $wbps_string = $product->get_title();
                    // Trimming length of string
                    $new_wbps_string = mb_strimwidth($wbps_string, 0, 29, "...");
                    echo esc_html($new_wbps_string); ?>
                </div>
                <nav class="nav">
                    <a class="border rounded btn-dark btn-sm text-light" id="wbpsPrev" style="cursor:pointer;">prev</a>
                    <a style="cursor:pointer;" class="text-light border rounded btn-dark btn-sm" id="wbpsNext">next</a>
                </nav>
            </div>
            <svg class="close_button" style="cursor: pointer; height: 25px;" data-bs-dismiss="modal" aria-label="Close" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M13.4,12l6.3-6.3c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L12,10.6L5.7,4.3c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4
	l6.3,6.3l-6.3,6.3C4.1,18.5,4,18.7,4,19c0,0.6,0.4,1,1,1c0.3,0,0.5-0.1,0.7-0.3l6.3-6.3l6.3,6.3c0.2,0.2,0.4,0.3,0.7,0.3
	s0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0-1.4L13.4,12z"/></svg>
            </div>
            <div class="modal-body">
                <?php
 if ((!empty($wbps_preview_pdf_link))) {
    require_once plugin_dir_path(__FILE__) . 'pdfSettings/wbpsWooPdfViewer.php';
 } ?>
    </div>
            <div class="modal-footer h-10 d-flex justify-content-between">
            <div class="pages text-center">
                <span class="mr-2">Page </span>
                <span id="wbpsCurrentPage">0</span>
                <span class="mx-1">/</span>
                <span id="wbpsTotalPages">0</span>
            </div>
            <a id="aboutBtn" class="btn-dark btn-sm text-light" data-bs-toggle="collapse" data-bs-target="#collapseAuthorDetails" aria-expanded="false" aria-controls="collapseAuthorDetails">About</a>
<div class="collapse" id="collapseAuthorDetails">
<div class="card card-body">
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
</div>
</div>