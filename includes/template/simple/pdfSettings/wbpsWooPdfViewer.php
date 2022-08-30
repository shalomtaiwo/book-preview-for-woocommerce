<?php
if ( ! defined( 'WPINC' ) ) {die;} // end if
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title></title>
    <style>
    canvas {
        width: 100%;
        height: 100%;
    }
    </style>
</head>

<body>
    <div class="flex-grow"><canvas id="wbpspdfviewer">
            <p>Loading... </p>
        </canvas></div>
</body>

</html>
<?php
if (!defined('WBPS_WORKER_PDF_JS')) define('WBPS_WORKER_PDF_JS', plugins_url( 'pdfjsBuild/build', __FILE__ ));
?>
<script type="text/javascript" src="<?php echo esc_url(WBPS_WORKER_PDF_JS);?>/pdf.min.js"></script>
<script>
const url = "<?php echo esc_url($wbps_preview_pdf_link)?>";
const pdfjsLib = window["pdfjs-dist/build/pdf"];

pdfjsLib.GlobalWorkerOptions.workerSrc = "<?php echo esc_url(WBPS_WORKER_PDF_JS);?>/pdf.worker.min.js";
let pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1,
    canvas = document.getElementById("wbpspdfviewer"),
    ctx = canvas.getContext("2d");
/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */

function renderPage(num) {
    pageRendering = true; // Using promise to fetch the page

    pdfDoc.getPage(num).then(function(page) {
        const viewport = page.getViewport({
            scale
        });
        canvas.height = viewport.height;
        canvas.width = viewport.width; // Render PDF page into canvas context

        var renderContext = {
            canvasContext: ctx,
            viewport: viewport
        };
        var renderTask = page.render(renderContext); // Wait for rendering to finish

        renderTask.promise.then(function() {
            pageRendering = false;

            if (pageNumPending !== null) {
                // New page rendering is pending
                renderPage(pageNumPending);
                pageNumPending = null;
            }
        });
    }); // Update page counters

    document.getElementById("wbpsCurrentPage").textContent = num;
}
/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */


function queueRenderPage(num) {
    if (pageRendering) {
        pageNumPending = num;
    } else {
        renderPage(num);
    }
}
/**
 * Asynchronously downloads PDF.
 */


pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById("wbpsTotalPages").textContent = pdfDoc.numPages; // Initial/first page rendering

    renderPage(pageNum || 1);
});

function onPrevPage() {
    if (pageNum <= 1) {
        return;
    }

    pageNum--;
    queueRenderPage(pageNum);
}

document.getElementById("wbpsPrev").addEventListener("click", onPrevPage);

function onNextPage() {
    if (pageNum >= pdfDoc.numPages) {
        return;
    }

    pageNum++;
    queueRenderPage(pageNum);
}

document.getElementById("wbpsNext").addEventListener("click", onNextPage);
</script>