<?php 
include "includes/connection.php";
include "includes/header.php";
include "modules/main_page.php";


?>



<?php
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "deleted") {
        echo '<div class="position-fixed top-0 start-50 translate-middle-x w-100" style="z-index: 1050;">
                <div id="alertMsg" class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <strong>Success!</strong> Employee data has been <strong>deleted successfully</strong>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
    } elseif ($_GET['msg'] == "notdeleted") {
        echo '<div class="position-fixed top-0 start-50 translate-middle-x w-100" style="z-index: 1050;">
                <div id="alertMsg" class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <strong>Error!</strong> Employee data could <strong>not be deleted</strong>. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
    }
}
?>

<script>
    // Auto-dismiss alert after 3 seconds
    window.addEventListener('DOMContentLoaded', () => {
        const alert = document.getElementById('alertMsg');
        if (alert) {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();

                // Remove msg from URL without reloading
                const url = new URL(window.location);
                url.searchParams.delete('msg');
                window.history.replaceState({}, document.title, url.toString());
            }, 3000);
        }
    });
</script>
