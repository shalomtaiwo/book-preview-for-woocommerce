jQuery(function (o) {
  o(document).ready(function () {
    var elements = jQuery(".wbps-modal-overlay, .wbps-modal");

    jQuery(".wbps_popup_btnsimple_pdf").click(function () {
      elements.addClass("active");
    });
    jQuery(".wbps_popup_btnsimple").click(function () {
      elements.addClass("active");
    });

    jQuery(".close-wbps-modal").click(function () {
      elements.removeClass("active");
    });
    jQuery(".wbps_popup_btnsimple_pdf").click(function (d) {
      d.stopPropagation();
      jQuery("body").addClass("overflow-hidden");
      jQuery("html").addClass("overflow-hidden");
    });
    jQuery(".wbps_popup_btnsimple").click(function (d) {
      d.stopPropagation();
      jQuery("body").addClass("overflow-hidden");
      jQuery("html").addClass("overflow-hidden");
    });
    jQuery(".close-wbps-modal").click(function (d) {
      d.stopPropagation();
      jQuery("body").removeClass("overflow-hidden");
      jQuery("html").removeClass("overflow-hidden");
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const collapseBtn = document.getElementById("wbps-collapseBtn");
  const collapseContent = document.getElementById("wbps-collapseContent");

  collapseBtn.addEventListener("click", function () {
    if (collapseContent.style.maxHeight) {
      collapseContent.style.maxHeight = null; // Collapse the content
      collapseContent.style.padding = 0;
      collapseContent.style.border = 0;
    } else {
      collapseContent.style.maxHeight = 91 + "px"; // Expand the content
      collapseContent.style.padding = 20 + "px";
      collapseContent.style.border = 1 + "px" + " solid";
    }
  });
});
