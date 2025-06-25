<?php
if (!defined('WPINC')) {
    die;
}
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
        .wbps-search-container {
            margin: 10px 0;
        }
        .search-results {
            margin-top: 20px;
        }
        .search-result {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="flex-grow">
        <canvas id="wbpspdfviewer" dir="ltr">
            <p>Loading... </p>
        </canvas>

    </div>
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
        ctx = canvas.getContext("2d"),
        wbpsSearchResults = [],
        currentSearchIndex = -1;

    function renderPage(num) {
        pageRendering = true;

        pdfDoc.getPage(num).then(function (page) {
            const viewport = page.getViewport({ scale });
            canvas.height = viewport.height;
            canvas.style.width = "100%";
            canvas.width = viewport.width;

            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);

            renderTask.promise.then(function () {
                pageRendering = false;
                if (pageNumPending !== null) {
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });

        document.getElementById("wbpsCurrentPage").textContent = num;
    }

    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById("wbpsTotalPages").textContent = pdfDoc.numPages;
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
        document.getElementById("wbpsAlert").classList.remove("wbps-last-page");
        queueRenderPage(pageNum);
    }

    function searchPage(doc, pageNumber) {
        return doc.getPage(pageNumber).then(function (page) {
            return page.getTextContent();
        }).then(function (content) {
            var text = content.items.map(function (i) { return i.str; }).join('');
            var wbpsSearchText = document.getElementById("wbpsSearchText").value;
            var re = new RegExp("(.{0,20})" + wbpsSearchText + "(.{0,20})", "gi"), m;
            var lines = [];
            while (m = re.exec(text)) {
                var line = (m[1] ? "..." : "") + m[0] + (m[2] ? "..." : "");
                lines.push(line);
            }
            return lines.length > 0 ? {page: pageNumber, items: lines} : null;
        });
    }

    document.getElementById("wbpsSearchButton").addEventListener("click", function() {
        var resultsContainer = document.getElementById("wbpsSearchResults");
        resultsContainer.innerHTML = '';
        wbpsSearchResults = [];
        currentSearchIndex = -1;

        var loading = pdfjsLib.getDocument(url);
        loading.promise.then(function (doc) {
            var results = [];
            for (var i = 1; i <= doc.numPages; i++)
                results.push(searchPage(doc, i));
            return Promise.all(results);
        }).then(function (wbpsSearchResultsArray) {
            wbpsSearchResults = wbpsSearchResultsArray.filter(result => result !== null);
            if (wbpsSearchResults.length > 0) {
                currentSearchIndex = 0;
                showSearchResult(currentSearchIndex);
                document.getElementById("wbpsNextButton").style.display = "inline";
                document.getElementById("wbpsCancelButton").style.display = "inline";
            } else {
                resultsContainer.innerHTML = '<div class="search-result">Nothing found</div>';
                document.getElementById("wbpsNextButton").style.display = "none";
            }
        }).catch(console.error);
    });

    document.getElementById("wbpsNextButton").addEventListener("click", function() {
        if (wbpsSearchResults.length > 0) {
            currentSearchIndex = (currentSearchIndex + 1) % wbpsSearchResults.length;
            showSearchResult(currentSearchIndex);
        }
    });

    document.getElementById("wbpsCancelButton").addEventListener("click", function() {
    document.getElementById("wbpsSearchText").value = '';
    document.getElementById("wbpsSearchResults").innerHTML = '';
    document.getElementById("wbpsNextButton").style.display = 'none';
    wbpsSearchResults = [];
    currentSearchIndex = -1;
    document.getElementById("wbpsCancelButton").style.display = 'none';
});

    function showSearchResult(index) {
        var result = wbpsSearchResults[index];
        var resultsContainer = document.getElementById("wbpsSearchResults");
        resultsContainer.innerHTML = '';
        var div = document.createElement('div');
        div.className = "search-result";
        resultsContainer.appendChild(div);
        div.textContent = 'Page ' + result.page + ':';
        result.items.forEach(function (s) {
            var div2 = document.createElement('div');
            div2.className = "search-result-item";
            div.appendChild(div2);
            div2.textContent = s;
        });
        pageNum = result.page;
        queueRenderPage(pageNum);
    }
</script>
