<?php
include __DIR__ . '/../config.php'; 
include $basePath . 'includes/connection.php'; // procedural mysqli $conn
include $basePath . 'includes/helper_functions.php'; // general helpers

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Collect & Sanitize inputs ---
    $emp_name        = mysqli_real_escape_string($conn, $_POST['emp_name'] ?? '');
    $emp_type        = mysqli_real_escape_string($conn, $_POST['emp_type'] ?? '');
    $work_status     = mysqli_real_escape_string($conn, $_POST['work_status'] ?? '');
    $emp_email       = mysqli_real_escape_string($conn, $_POST['emp_email'] ?? '');
    $emp_mobile      = mysqli_real_escape_string($conn, $_POST['emp_mobile'] ?? '');
    $emp_address_1   = mysqli_real_escape_string($conn, $_POST['location'] ?? '');
    $emp_address_2   = mysqli_real_escape_string($conn, $_POST['emp_address'] ?? '');
    $emp_city        = mysqli_real_escape_string($conn, $_POST['location'] ?? '');
    $emp_country     = mysqli_real_escape_string($conn, $_POST['emp_country'] ?? '');
    $emp_hire_date   = mysqli_real_escape_string($conn, $_POST['emp_hire_date'] ?? '');
    $emp_gender      = mysqli_real_escape_string($conn, $_POST['emp_gender'] ?? '');
    $job_title       = mysqli_real_escape_string($conn, $_POST['job_title'] ?? '');
    $emp_level       = mysqli_real_escape_string($conn, $_POST['emp_level'] ?? '');
    $business_area   = mysqli_real_escape_string($conn, $_POST['business_area'] ?? '');
    $linkedin_url    = mysqli_real_escape_string($conn, $_POST['linkedin_url'] ?? '');
    $github          = mysqli_real_escape_string($conn, $_POST['github'] ?? '');
    $educational_lvl = mysqli_real_escape_string($conn, $_POST['educational_level'] ?? '');
    $experience_years= mysqli_real_escape_string($conn, $_POST['experience_years'] ?? '');
    $current_salary  = mysqli_real_escape_string($conn, $_POST['current_salary'] ?? '');
    $expected_salary = mysqli_real_escape_string($conn, $_POST['expected_salary'] ?? '');
    $notice_period   = mysqli_real_escape_string($conn, $_POST['notice_period'] ?? '');
    $portfolio       = mysqli_real_escape_string($conn, $_POST['portfolio'] ?? '');
    $tool_proficiency= mysqli_real_escape_string($conn, $_POST['tool_proficiency'] ?? '');
    $best_fit        = mysqli_real_escape_string($conn, $_POST['best_fit'] ?? '');
    $manage_team     = mysqli_real_escape_string($conn, $_POST['manage_team'] ?? '');
    $company_interest= mysqli_real_escape_string($conn, $_POST['company_interest'] ?? '');
    $sps_corporate   = mysqli_real_escape_string($conn, $_POST['job_title'] ?? '');
    $staff           = mysqli_real_escape_string($conn, $_POST['job_title'] ?? '');
    $personal_email  = mysqli_real_escape_string($conn, $_POST['personal_email'] ?? '');

    
    if (!empty($errors)) {
        foreach ($errors as $err) {
            echo "<p style='color:red;'>❌ $err</p>";
        }
        exit;
    }

    // --- File Upload (using helpers) ---
    $cover_letter = '';
    if (!empty($_FILES['cover_letter']['name'])) {
        $file = $_FILES['cover_letter'];
        $uploadDir = $basePath . "assets/uploads/cover_letters/";

        if (file_uploaded($file) &&
            file_size_ok($file, 5) &&
            file_extension_ok($file, ['pdf','doc','docx','png','jpg','jpeg'])) {

            $targetFile = unique_filename($file, $uploadDir, false);

            if (save_file($file, $targetFile)) {
                $cover_letter = str_replace($basePath, '', $targetFile);
            } else {
                die("❌ Failed to save cover letter. Check folder permissions.");
            }
        } else {
            die("❌ Invalid cover letter file. Error code: " . $file['error']);
        }
    }

    // --- Insert into timelive_emp ---
    $sql_emp = "
        INSERT INTO timelive_emp 
        (emp_name, emp_email, emp_mobile, emp_address_1, emp_address_2, 
         emp_city, emp_country, emp_hire_date, emp_gender, 
         company, sps_corporate, staff, personal_email)
        VALUES (
            '$emp_name', '$emp_email', '$emp_mobile', '$emp_address_1',
            '$emp_address_2', '$emp_city', '$emp_country', '$emp_hire_date',
            '$emp_gender', '$company_interest', '$sps_corporate', '$staff', '$personal_email'
        )
    ";

    if (!mysqli_query($conn, $sql_emp)) {
        die("Error inserting into timelive_emp: " . mysqli_error($conn));
    }

    $emp_id = mysqli_insert_id($conn);

    // --- Insert into jobs_apply ---
    $sql_apply = "
        INSERT INTO jobs_apply (
            emp_id, email, apply_date, apply_time, status,
            linkedIn, github, highest_education, experience_years,
            location_islamabad, type, current_salary, expected_salary,
            notice_period, company_interest, portfolio, tool_proficiency, best_fit, manage_team,
            cover_letter
        ) VALUES (
            '$emp_id', '$emp_email', CURDATE(), CURTIME(), '$work_status',
            '$linkedin_url', '$github', '$educational_lvl', '$experience_years',
            '$emp_city', '$emp_type', '$current_salary', '$expected_salary',
            '$notice_period', '$company_interest', '$portfolio', '$tool_proficiency', '$best_fit', '$manage_team',
            '$cover_letter'
        )
    ";

    if (!mysqli_query($conn, $sql_apply)) {
        die("Error inserting into jobs_apply: " . mysqli_error($conn));
    }

    // --- Insert into emp_history ---
    $sql_history = "
        INSERT INTO emp_history (
            emp_id, department_id, group_id, practice_id, role_id, 
            hire_date, job_title, functional_role, created_by, updated_by
        ) VALUES (
            '$emp_id', NULL, NULL, NULL, NULL, 
            '$emp_hire_date', '$job_title', '$best_fit', 'self', 'self'
        )
    ";

    if (!mysqli_query($conn, $sql_history)) {
        die("Error inserting into emp_history: " . mysqli_error($conn));
    }

    // --- Success ---
    header("Location: employee_dashboard.php");
    exit();
}
?>
