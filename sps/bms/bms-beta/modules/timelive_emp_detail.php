<?php

include __DIR__ . '/../config.php'; // Load base path
include $basePath . 'includes/connection.php';
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD']=== 'POST')
    $Emergency_no=$_POST['emergency_no'];
$_home_address=$_POST['home_no'];

$sql="INSERT INTO `timelive_emp_detail`(`emergency_no`, `home_no`) VALUES ('$Emergency_no','$_home_address')";
if($conn->query($sql)===True)
{
   header("Location: employee_dashboard.php");

}
else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>