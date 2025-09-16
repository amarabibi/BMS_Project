<?php
include __DIR__ . '/../config.php'; 
include $basePath . 'includes/connection.php'; 
include $basePath . 'includes/helper_functions.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect inputs
    $department_id   = $_POST['department_id'] ?? '';
    $group_id        = $_POST['group_id'] ?? '';
    $practice_id     = $_POST['practice_id'] ?? '';
    $role_id         = $_POST['role_id'] ?? '';
    $job_title       = $_POST['job_title'] ?? '';
    $functional_role = $_POST['functional_role'] ?? '';
    $corporate_role  = $_POST['corporate_role'] ?? '';
    $hire_date       = $_POST['hire_date'] ?? '';

    // ✅ General validation checks
    $errors = [];

   
    // ✅ Show all errors if any
    if (!empty($errors)) {
        foreach ($errors as $err) {
            echo "<p style='color:red;'>❌ $err</p>";
        }
        exit;
    }

    // ✅ Escape values for DB
    $department_id   = mysqli_real_escape_string($conn, $department_id);
    $group_id        = mysqli_real_escape_string($conn, $group_id);
    $practice_id     = mysqli_real_escape_string($conn, $practice_id);
    $role_id         = mysqli_real_escape_string($conn, $role_id);
    $job_title       = mysqli_real_escape_string($conn, $job_title);
    $functional_role = mysqli_real_escape_string($conn, $functional_role);
    $corporate_role  = mysqli_real_escape_string($conn, $corporate_role);
    $hire_date       = mysqli_real_escape_string($conn, $hire_date);

    // ✅ Insert SQL
    $sql = "INSERT INTO emp_history 
            (department_id, group_id, practice_id, role_id, job_title, functional_role, corporate_role, hire_date) 
            VALUES ('$department_id', '$group_id', '$practice_id', '$role_id', '$job_title', '$functional_role', '$corporate_role', '$hire_date')";

    if (mysqli_query($conn, $sql)) {
        header("Location: employee_dashboard.php");
        exit;
    } else {
        echo "❌ Database error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
