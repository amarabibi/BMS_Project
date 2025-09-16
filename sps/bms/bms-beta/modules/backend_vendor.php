<?php
include __DIR__ . '/../config.php'; // Load base path
include $basePath . 'includes/connection.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- Collect & sanitize form inputs ---
    $vnd_name         = $_POST['vnd_name'];
    $vnd_url          = $_POST['vnd_url'];
    $vnd_status       = $_POST['vnd_status'];
    $slug             = $_POST['slug'];
    $web_publish      = isset($_POST['web_publish']) ? 1 : 0;
    $publish_tiles    = isset($_POST['publish_tiles']) ? 1 : 0;
    $training_partner = isset($_POST['training_partner']) ? 1 : 0;
    $order            = ($_POST['order']);
    $added_on         = date("Y-m-d H:i:s");
    $added_by         = $_POST['added_by'];
}
    // --- Insert Query ---
    $sql = "INSERT INTO timelive_emp_certs_vendors 
            (vnd_name, vnd_status, vnd_url, slug, web_publish, publish_tiles, training_partner, `order`, added_by, added_on)
            VALUES 
            ('$vnd_name', '$vnd_status', '$vnd_url', '$slug', '$web_publish', '$publish_tiles', '$training_partner',
             '$order', '$added_by', '$added_on')";

    if ($conn->query($sql) === TRUE) {
        header("Location: employee_dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }

?>
