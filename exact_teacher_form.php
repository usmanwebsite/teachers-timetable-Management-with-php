<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="#" method="post"> 

<div class="row">
    <div class="col">
        <label for="">teacher_name</label>

    </div>
    <div class="col">
        <input type="text" name="teacher" required>
    </div>
</div>

<input type="submit" name="submit" >

</form>
    
</body>
</html>

<?php

include('connection.php');


if(isset($_POST['submit']))
{
    $teacher =$_POST['teacher'];

    $sql="INSERT INTO exact_teachers(teachers) VALUES('$teacher') ";
    $result =mysqli_query($conn,$sql);
    if($result)
    {
        header("location: generate_timetable.php");
    }
}


?>