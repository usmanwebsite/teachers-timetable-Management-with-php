<?php
include('connection.php');

if(isset($_POST['submit']))
{
    $name=$_POST['teacher_name'];
    $course=$_POST['course_code'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $subject=$_POST['subject'];
    $subject_title = $_POST['title'];
    
    $sql="INSERT INTO teachers(teacher_name,timetables_id,email,phone,subject_taught,subject_title) VALUES('$name','$course','$email','$phone','$subject','$subject_title') ";
    $run= mysqli_query($conn,$sql);

    if($run)
    {
        header("location: time_form.php");
        echo "Teacher Insert Successfully";
    }
}

?>