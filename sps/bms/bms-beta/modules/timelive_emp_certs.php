<?php
include __DIR__ . '/../config.php';
include $basePath . 'includes/connection.php';  
include $basePath . 'includes/helper_functions.php'; // ✅ validation + file helpers

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect POST data
    $certtitle_id     = $_POST['certtitle_id'] ?? '';
    $cert_code        = $_POST['cert_code'] ?? '';
    $cert_url         = $_POST['cert_url'] ?? '';
    $cert_status      = $_POST['cert_status'] ?? '';
    $cert_exam_date   = $_POST['cert_exam_date'] ?? '';
    $cert_expiry_date = $_POST['cert_expiry_date'] ?? '';
    $cert_score       = $_POST['cert_score'] ?? '';
    $created_on       = $_POST['created_on'] ?? date('Y-m-d');
    $cert_attachment  = '';

    // ==== File upload ====
    if (!empty($_FILES['cert_attachment']['name'])) {
        $file = $_FILES['cert_attachment'];

        $certCode  = preg_replace('/[^a-zA-Z0-9_-]/', '_', $cert_code ?: 'unknown');
        $today     = date('Y-m-d');
        $uploadDir = $basePath . "assets/uploads/cert_$certCode/$today/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (file_uploaded($file) && 
            file_size_ok($file, 8) && 
            file_extension_ok($file, ['pdf','doc','docx','png','jpg','jpeg'])) {

            $targetFile = $uploadDir . uniqid("doc_", true) . "." . strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $cert_attachment = str_replace($basePath, '', $targetFile); // relative path
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
    $certtitle_id     = mysqli_real_escape_string($conn, $certtitle_id);
    $cert_code        = mysqli_real_escape_string($conn, $cert_code);
    $cert_url         = mysqli_real_escape_string($conn, $cert_url);
    $cert_status      = mysqli_real_escape_string($conn, $cert_status);
    $cert_exam_date   = mysqli_real_escape_string($conn, $cert_exam_date);
    $cert_expiry_date = mysqli_real_escape_string($conn, $cert_expiry_date);
    $cert_score       = mysqli_real_escape_string($conn, $cert_score);
    $created_on       = mysqli_real_escape_string($conn, $created_on);
    $cert_attachment  = mysqli_real_escape_string($conn, $cert_attachment);

    // Insert record
    $sql = "INSERT INTO timelive_emp_certs
            (certtitle_id, cert_code, cert_url, cert_status, created_on,
             cert_exam_date, cert_expiry_date, cert_score, cert_attachment)
            VALUES ('$certtitle_id', '$cert_code', '$cert_url', '$cert_status',
                    '$created_on', '$cert_exam_date', '$cert_expiry_date',
                    '$cert_score', '$cert_attachment')";

    if (mysqli_query($conn, $sql)) {
      
         header("Location: employee_dashboard.php");
         exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">❌ Database error: ' . mysqli_error($conn) . '</div>';
    }
}
?>
