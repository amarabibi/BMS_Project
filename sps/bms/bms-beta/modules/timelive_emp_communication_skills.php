<?php
include __DIR__ . '/../config.php'; // Load base path
include $basePath . 'includes/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') 

    // Collect inputs safely
    $user_id         =  $_POST['user_id'] ;
    $count_writing   =  $_POST['count_writing'] ;
    $count_listening =  $_POST['count_listening'] ;
    $count_speaking  =  $_POST['count_speaking'] ;
    $comments        =  $_POST['comments'] ;
    $added_on        =  $_POST['added_on'] ;

    // SQL insert query
    $sql = "INSERT INTO timelive_emp_communication_skills (
             user_id, 
                count_writing, count_listening, count_speaking, 
                comments, added_on
            ) VALUES (
                " . (!empty($user_id) ? "'$user_id'" : "NULL") . ",
                " . (!empty($count_writing) ? "'$count_writing'" : "NULL") . ",
                " . (!empty($count_listening) ? "'$count_listening'" : "NULL") . ",
                " . (!empty($count_speaking) ? "'$count_speaking'" : "NULL") . ",
                " . (!empty($comments) ? "'$comments'" : "NULL") . ",
                '$added_on'
            )";
if($conn->query($sql)===TRUE)
{
   header("Location: employee_dashboard.php");
}
else{
    echo "error";
}
      
?>
