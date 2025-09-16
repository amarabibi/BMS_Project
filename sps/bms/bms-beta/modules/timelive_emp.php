<?php
include __DIR__ . '/../config.php';
include $basePath . 'includes/connection.php';
header('Content-Type: application/json');

// Collect all fields in one step
$emp_name       = $_POST['emp_name']       ?? '';
$emp_email      = $_POST['emp_email']      ?? '';
$emp_mobile     = $_POST['emp_mobile']     ?? '';
$emp_address_1  = $_POST['location']  ?? '';
$emp_address_2  = $_POST['emp_address']  ?? '';
$emp_city       = $_POST['location']       ?? '';
$emp_country    = $_POST['emp_country']    ?? '';
$emp_hire_date  = $_POST['emp_hire_date']  ?? '';
$emp_gender     = $_POST['emp_gender']     ?? '';
$company        = $_POST['company_interest']        ?? '';
$sps_corporate  = $_POST['sps_corporate']  ?? '';
$staff          = $_POST['staff']          ?? '';
$personal_email = $_POST['personal_email'] ?? '';

// Required check
if (!$emp_name || !$emp_email) {
    echo json_encode(["status" => "error", "message" => "Employee Name and Email are required."]);
    exit;
}

// Query
$sql = "INSERT INTO timelive_emp 
        (emp_id, emp_name, emp_email, emp_mobile, emp_address_1, emp_address_2, 
         emp_city, emp_country, emp_hire_date, emp_gender, 
         company, sps_corporate, staff, personal_email)
        VALUES ('$emp_id','$emp_name','$emp_email','$emp_mobile','$emp_address_1',
                '$emp_address_2','$emp_city','$emp_country','$emp_hire_date',
                '$emp_gender','$company','$sps_corporate','$staff','$personal_email')";
if ($conn->query($sql) === TRUE) {

    header("Location: employee_dashboard.php");
} else {
    echo "<script>
        alert('Error: " . addslashes($conn->error) . "');
    </script>";
}

?>
