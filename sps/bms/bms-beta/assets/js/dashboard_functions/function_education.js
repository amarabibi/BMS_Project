$(document).ready(function () {
  $("#educationform").on("submit", function (e) {
    e.preventDefault(); // stop default form submit

    const $form = $(this);
    const $button = $form.find('button[type="submit"]');
    const modalEl = document.getElementById("educationModal"); // change ID if needed

    // disable button while saving
    $button.prop("disabled", true).text("Saving...");

    $.ajax({
      url: "../../../modules/backend/employee_data/education_backend.php", // ✅ fixed
      type: "POST",
      data: $form.serialize(),
      dataType: "json",
      success: function (res) {
        if (res.status === "success") {
          // ✅ reset form
          $form[0].reset();

          // re-enable button
          $button.prop("disabled", false).text("Save");

          // ✅ close modal
          if (window.bootstrap && bootstrap.Modal) {
            const modal =
              bootstrap.Modal.getInstance(modalEl) ||
              new bootstrap.Modal(modalEl);
            modal.hide();

            // reload page after modal hides
            modalEl.addEventListener(
              "hidden.bs.modal",
              () => location.reload(),
              { once: true }
            );
          }
        } else {
          alert("⚠️ " + res.message);
          $button.prop("disabled", false).text("Save");
        }
      },
      error: function (xhr, status, error) {
        let message = "❌ Something went wrong.";
        try {
          const res = JSON.parse(xhr.responseText);
          if (res.message) message = "❌ " + res.message;
        } catch (e) {
          console.error("AJAX Error:", status, error, xhr.responseText);
        }
        alert(message);
        $button.prop("disabled", false).text("Save");
      },
    });
  });
});
