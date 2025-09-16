<?php
header('Content-Type: application/json');
include __DIR__ . '/../config.php'; // Load base path
include $basePath . 'includes/connection.php';



if ($_SERVER["REQUEST_METHOD"] === "POST") 
   
    $badge_title  = $_POST['badge_title'];
    $badge_url    = $_POST['badge_url'];
    $completed_on = !empty($_POST['completed_on']) ? $_POST['completed_on'] : NULL;
    $expiry_date  = !empty($_POST['expiry_date']) ? $_POST['expiry_date'] : NULL;
    $created_on   = $_POST['created_on'];

    // 3. Prepare SQL
    $sql = "INSERT INTO timelive_emp_badges
            (badge_title, badge_url, completed_on, expiry_date, created_on) 
            VALUES ('$badge_title', '$badge_url', '$completed_on', '$expiry_date', '$created_on')";
 if($conn->query($sql) === TRUE){
header('Location: ' . 'employee_dashboard.php');

 }
 else{
    echo "Error: " . $sql . "<br>" . $conn->error;
 }
 
?>
