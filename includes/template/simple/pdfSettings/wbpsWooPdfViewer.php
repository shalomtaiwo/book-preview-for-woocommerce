<?php
if (!defined('WPINC')) {
    die;
} // end if
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
    <div class="flex-grow"><canvas id="wbpspdfviewer" dir="ltr">
            <p>Loading... </p>
        </canvas></div>
</body>

</html>
<?php
if (!defined('WBPS_WORKER_PDF_JS'))
    define('WBPS_WORKER_PDF_JS', plugins_url('pdfjsBuild/build', __FILE__));

$data = file_get_contents($wbps_preview_pdf_link);
$b64image = 'data:text/' . ';base64,' . base64_encode($data);

?>
<script>
    var BASE64_MARKER = ';base64,';

    function convertDataURIToBinary(dataURI) {
        var base64Index = dataURI.indexOf(BASE64_MARKER) + BASE64_MARKER.length;
        var base64 = dataURI.substring(base64Index);
        var raw = window.atob(base64);
        var rawLength = raw.length;
        var array = new Uint8Array(new ArrayBuffer(rawLength));

        for (var i = 0; i < rawLength; i++) {
            array[i] = raw.charCodeAt(i);
        }
        return array;
    }
</script>
<script type="text/javascript" src="<?php echo esc_url(WBPS_WORKER_PDF_JS); ?>/pdf.min.js"></script>
<script>
    const url = convertDataURIToBinary("<?php echo esc_attr($b64image) ?>");
    const pdfjsLib = window["pdfjs-dist/build/pdf"];

    pdfjsLib.GlobalWorkerOptions.workerSrc = "<?php echo esc_url(WBPS_WORKER_PDF_JS); ?>/pdf.worker.min.js";
    let pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 3,
        canvas = document.getElementById("wbpspdfviewer"),
        ctx = canvas.getContext("2d");
    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */

    function renderPage(num) {
        pageRendering = true; // Using promise to fetch the page

        pdfDoc.getPage(num).then(function (page) {
            const viewport = page.getViewport({
                scale
            });
            canvas.height = viewport.height;
            canvas.style.width = "100%";
            canvas.width = viewport.width; // Render PDF page into canvas context

            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext); // Wait for rendering to finish

            renderTask.promise.then(function () {
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


    pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById("wbpsTotalPages").textContent = pdfDoc.numPages; // Initial/first page rendering

        renderPage(pageNum || 1);
    });


    function onPrevPage() {
        if (pageNum <= 1) {
            document.getElementById("wbpsPrev").style.cursor = 'not-allowed';
            return;
        }
        pageNum--;
        document.getElementById("wbpsNext").style.cursor = 'pointer';
        document.getElementById("wbpsAlert").classList.add("wbps-not-last-page");
        queueRenderPage(pageNum);
    }

    document.getElementById("wbpsPrev").addEventListener("click", onPrevPage);


    document.getElementById("wbpsNext").addEventListener("click", onNextPage);

    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            document.getElementById("wbpsAlert").classList.remove("wbps-not-last-page");
            document.getElementById("wbpsAlert").classList.add("wbps-last-page");
            return;
        }

        pageNum++;
        document.getElementById("wbpsPrev").style.cursor = 'pointer';
        document.getElementById("wbpsNext").style.cursor = 'pointer';
        document.getElementById("wbpsAlert").classList.remove("wbps-last-page"); // Remove the class if it's not the last page
        queueRenderPage(pageNum);
    }
</script>