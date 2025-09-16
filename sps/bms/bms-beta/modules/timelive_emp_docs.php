<?php
include __DIR__ . '/../config.php'; 
include $basePath . 'includes/connection.php'; // procedural $conn
include $basePath . 'includes/helper_functions.php'; // validation + file helpers

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect fields
    $doc_title = $_POST['doc_title'] ?? '';
    $added_by  = $_POST['added_by'] ?? '';
    $doc_file  = '';


    // Show errors if any
    if (!empty($errors)) {
        echo '<div class="alert alert-danger" role="alert">';
        echo '<ul class="mb-0">';
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo '</ul>';
        echo '</div>';
        exit;
    }

    // ==== File upload ====
    if (!empty($_FILES['doc_attachment']['name'])) {
        $file = $_FILES['doc_attachment'];

        $uploadDir = $basePath . "assets/uploads/emp_docs/";

        if (file_uploaded($file) && 
            file_size_ok($file, 8) && 
            file_extension_ok($file, ['pdf','doc','docx','png','jpg','jpeg'])) {

            // Generate unique filename inside emp_docs/
            $targetFile = unique_filename($file, $uploadDir, false);

            if (save_file($file, $targetFile)) {
                // Save only relative path in DB
                $doc_file = str_replace($basePath, '', $targetFile);
            } else {
                echo '<div class="alert alert-warning" role="alert">❌ Failed to save file. Check folder permissions.</div>';
                exit;
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">❌ Invalid file upload.</div>';
            exit;
        }
    }

    // Escape for SQL
    $doc_title = mysqli_real_escape_string($conn, $doc_title);
    $doc_file  = mysqli_real_escape_string($conn, $doc_file);
    $added_by  = mysqli_real_escape_string($conn, $added_by);

    // Insert record
    $sql = "INSERT INTO timelive_emp_docs (doc_title, doc_attachment, added_by) 
            VALUES ('$doc_title', '$doc_file', '$added_by')";

    if (mysqli_query($conn, $sql)) {
       
         header("Location: employee_dashboard.php");
         exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">❌ Database error: ' . mysqli_error($conn) . '</div>';
    }
}
?>
