<?php
include __DIR__ . '/../config.php'; // Load base path
include $basePath . 'includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_id = intval($_POST['department_id']);
    $group_id = intval($_POST['group_id']);
    $practice_id = intval($_POST['practice_id']);
    $role_name = mysqli_real_escape_string($conn, $_POST['emp_role_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $added_by = 1; // session user id (dummy here)
    $added_on = date("Y-m-d H:i:s");

    $sql = "INSERT INTO tbl_emp_roles 
            (emp_role_name, department_id, group_id, practice_id, category, emp_role_status, added_by, added_on, emp_id) 
            VALUES 
            ('$role_name', $department_id, $group_id, $practice_id, '$category', 1, $added_by, '$added_on', 0)";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Role added successfully'); window.location.href='employee_dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
