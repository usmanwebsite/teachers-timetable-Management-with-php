<?php
include('connection.php');

if(isset($_POST['submit']))
{
    $timetable_id=$_POST['timetables'];
    $classroom_id=$_POST['classrooms'];
    $teacher_id=$_POST['teachers'];
    $exact_teacher =$_POST['exact_teachers'];
    $timeslots_id=$_POST['timeslots'];
    $timetable_for=$_POST['timetable_type'];
    
    $sql = "INSERT INTO department_timetables (timetables_id, teacher_id, exact_teachers, classrooms_id, timeslots_id, timetables_type) VALUES ('$timetable_id', '$teacher_id', '$exact_teacher', '$classroom_id', '$timeslots_id', '$timetable_for')";
    $run= mysqli_query($conn,$sql);

    if($run)
    {
        echo "Department Timetable Insert Successfully";
    }
}

?>