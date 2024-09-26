<?php

include('connection.php');

if(isset($_POST['submit']))
{
    $class_no=$_POST['class_no'];
    $class_type=$_POST['class_type'];
    $capacity=$_POST['capacity'];
    $projector=$_POST['projector'];
    
    $sql="INSERT INTO classrooms(class_no,class_type,capacity,Projector_availble) VALUES('$class_no','$class_type','$capacity','$projector') ";
    $run= mysqli_query($conn,$sql);

    if($run)
    {
        header("location: teacher_form.php");
        echo "Classroom Insert Successfully";
    }
}


?>