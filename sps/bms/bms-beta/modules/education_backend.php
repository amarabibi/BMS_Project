<?php
include __DIR__ . '/../config.php'; 
include $basePath . 'includes/connection.php'; 
include $basePath . 'includes/helper_functions.php'; // ✅ validation + file helpers

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect & sanitize POST fields
    $edu_level     = mysqli_real_escape_string($conn, $_POST['edu_level'] ?? '');
    $field_studies = mysqli_real_escape_string($conn, $_POST['field_studies'] ?? '');
   


    // ✅ Insert query
    $sql = "
        INSERT INTO timelive_emp_detail 
        (edu_level, field_studies)
        VALUES ('$edu_level', '$field_studies')
    ";

    if (mysqli_query($conn, $sql)) {
      
         header("Location: employee_dashboard.php");
         exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">
                ❌ Database error: ' . mysqli_error($conn) . '
              </div>';
    }

    mysqli_close($conn);
}
?>
