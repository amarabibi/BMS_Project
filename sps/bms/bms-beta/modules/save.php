<?php
include "../config.php";
include "includes/connection.php";
include $basePath . 'includes/header.php';


$emp_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$record_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// === Fetch Employee & History ===
$emp = null;
$history = null;
$record = null;


if ($emp_id > 0) {
    // Fetch employee info
    $empQuery = "SELECT * FROM timelive_emp WHERE emp_id = $emp_id";
    $empResult = mysqli_query($conn, $empQuery);
    $emp = mysqli_fetch_assoc($empResult);

    // Fetch history
    $historyQuery = "SELECT * FROM emp_history WHERE emp_id = $emp_id";
    $historyResult = mysqli_query($conn, $historyQuery);
    $history = mysqli_fetch_assoc($historyResult);
}

// === Handle Employee Update (timelive_emp) ===
if (isset($_POST['update_emp'])) {
    $emp_name   = mysqli_real_escape_string($conn, $_POST['emp_name']);
    $emp_email  = mysqli_real_escape_string($conn, $_POST['emp_email']);
    $emp_mobile = mysqli_real_escape_string($conn, $_POST['emp_mobile']);
    $emp_country = mysqli_real_escape_string($conn, $_POST['emp_country']);
    $staff      = isset($_POST['staff']) ? 1 : 0;
    $sps_corporate = isset($_POST['sps_corporate']) ? 1 : 0;

    $updateEmp = "
        UPDATE timelive_emp 
        SET emp_name='$emp_name',
            emp_email='$emp_email',
            emp_mobile='$emp_mobile',
            emp_country='$emp_country',
            staff=$staff,
            sps_corporate=$sps_corporate
        WHERE emp_id=$emp_id
    ";

    if (mysqli_query($conn, $updateEmp)) {
        echo "<div class='alert alert-success'>✅ Employee info updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}

// === Handle History Update (emp_history) ===
if (isset($_POST['update_history'])) {
    $hire_date       = mysqli_real_escape_string($conn, $_POST['hire_date']);
    $termination_date = mysqli_real_escape_string($conn, $_POST['termination_date']);
    $job_title       = mysqli_real_escape_string($conn, $_POST['job_title']);
    $functional_role = mysqli_real_escape_string($conn, $_POST['functional_role']);
    $corporate_role  = mysqli_real_escape_string($conn, $_POST['corporate_role']);

    $updateHistory = "
        UPDATE emp_history 
        SET 
            hire_date='$hire_date',
            termination_date='$termination_date',
            job_title='$job_title',
            functional_role='$functional_role',
            corporate_role='$corporate_role',
            updated_at=NOW(),
            updated_by='system'
        WHERE emp_id=$emp_id
    ";

    if (mysqli_query($conn, $updateHistory)) {
        echo "<div class='alert alert-success'>✅ History updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
// Fetch existing record
if ($record_id > 0) {
    $query = "SELECT * FROM timelive_emp_communication_skills WHERE id = $record_id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $record = mysqli_fetch_assoc($result);
    }
}

// Handle update
if (isset($_POST['update_comm'])) {
    $user_id         = intval($_POST['user_id']);
    $count_writing   = intval($_POST['count_writing']);
    $count_listening = intval($_POST['count_listening']);
    $count_speaking  = intval($_POST['count_speaking']);
    $comments        = mysqli_real_escape_string($conn, $_POST['comments']);
    $added_on        = mysqli_real_escape_string($conn, $_POST['added_on']);

    $update_sql = "
        UPDATE timelive_emp_communication_skills
        SET user_id = $user_id,
            count_writing = $count_writing,
            count_listening = $count_listening,
            count_speaking = $count_speaking,
            comments = '$comments',
            added_on = '$added_on'
        WHERE id = $record_id
    ";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>
                alert('Communication skills updated successfully!');
                window.location.href='employee_dashboard.php';
              </script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>


