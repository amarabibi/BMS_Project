<?php
include '../config.php'; 
include "includes/connection.php";

if (!isset($_GET['id'])) {
    header("Location: http://localhost/my-site/sps/bms/bms-beta/index.php?msg=notdeleted");
    exit;
}

$emp_id = intval($_GET['id']);

// Step 1: Delete from timelive_emp
$sql1 = "DELETE FROM timelive_emp WHERE emp_id = $emp_id";
if (!mysqli_query($conn, $sql1)) {
    header("Location: http://localhost/my-site/sps/bms/bms-beta/index.php?msg=notdeleted");
    exit;
}

// Step 2: Delete from emp_history
$sql2 = "DELETE FROM emp_history WHERE emp_id = $emp_id";
if (!mysqli_query($conn, $sql2)) {
    header("Location: http://localhost/my-site/sps/bms/bms-beta/index.php?msg=notdeleted");
    exit;
}

// Step 3: Delete from jobs_apply
$sql3 = "DELETE FROM jobs_apply WHERE emp_id = $emp_id";
if (!mysqli_query($conn, $sql3)) {
    header("Location: http://localhost/my-site/sps/bms/bms-beta/index.php?msg=notdeleted");
    exit;
}

// ✅ If everything is fine
header("Location: http://localhost/my-site/sps/bms/bms-beta/index.php?msg=deleted");

mysqli_close($conn);
?>
