// ============gallery edit==============
$(document).ready(function () {
  $("#gallery_edit").DataTable();
});
// ==========================
// ============pkg_edit edit==============
$(document).ready(function () {
  $("#pkg_edit").DataTable();
});
// ==========================
setTimeout(() => {
  hideOverlay();
}, 5000);

function hideOverlay() {
  const overlay = document.getElementById("overlay");
  if (overlay) {
    overlay.remove(); // or overlay.style.display = 'none';
  }
}
// ==========================
$(document).ready(function () {
  $("#writ_blog_form").parsley();
});

$(document).ready(function () {
  $("#blog_form").parsley();
});
// ==========================
$(document).ready(function() {
  if ($("#country").length) {
    new TomSelect("#country", {
      create: false,
      sortField: {
        field: "text",
        direction: "asc",
      },
    });
  }
});

// ==========================
$(document).ready(function() {
  if ($("#curd_country").length) {
    new TomSelect("#curd_country", {
      create: false,
      sortField: {
        field: "text",
        direction: "asc",
      },
    });
  }
});
// ==========================
$(document).ready(function () {
  $("#feedback_form").parsley();
});
// ==========================
    $(document).ready(function() {
        $('#bookingForm').parsley();
    });

// ==========================
