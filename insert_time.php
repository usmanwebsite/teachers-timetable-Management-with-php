<?php
include('connection.php');

if (isset($_POST['submit'])) {
    $week = $_POST['week'];
    $start_time = $_POST['s_time'];
    $end_time = $_POST['e_time'];
    $subject_type = $_POST['subject_type'];
    $section = $_POST['section'];

    $is_exam = $_POST['is_exam'];


    $formattedTime = date("h:i A", strtotime($start_time));
    //echo $formattedTime;

    $sql="INSERT INTO time_slots(day_of_week,start_time,end_time,subject_type,section,is_exam) VALUES('$week','$formattedTime','$end_time','$subject_type','$section','$is_exam') ";
    $run= mysqli_query($conn,$sql);

    if ($run) {
        header("location: Department_timetable_form.php");
        echo "Time Insert Successfully";
    }
}
