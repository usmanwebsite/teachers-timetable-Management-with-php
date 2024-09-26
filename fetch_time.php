<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Time</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <style>
     
     button{
        background-color: green;
        color: white;
        margin-right: 5px;
     }
     table tr td{
        border: 2px black solid;
        text-align: center;
     }
     table tr th{
        border: 2px black solid;
        text-align: center;
     }
    </style>
</head>
<body>
    <div class="container">
<table class="table table-hover">
  <thead>
    <tr>
    <th>Time_id</th>
    <th>day_of_week</th>
    <th>start_time</th>
    <th>end_time</th>
    <th>subject_type</th>
    <th>Section</th>
    <th>is_exam</th>
    <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>



<?php
include ("connection.php");

$query= "SELECT * FROM time_slots";
$execute= mysqli_query($conn,$query);



  while( $record= mysqli_fetch_assoc($execute))
  {

    echo "
        <th>".$record['time_id']."</th> 
       <td>".$record['day_of_week']."</td>     
       <td>".$record['start_time']."</td>     
       <td>".$record['end_time']."</td>
       <td>".$record['subject_type']."</td> 
       <td>".$record['section']."</td>     
       <td>".$record['is_exam']."</td>     
       <td><a  href='update_timeslots.php?ti_id=$record[time_id]'> <button> Edit </button></a></td>
       <td><a href ='delete_timeslots.php?ti_id=$record[time_id]'><button> Delete  </button> </a></td> 

     </tr>

    ";
}

// SELECT teachers.teacher_name, teachers.email, time_slots.day_of_week, time_slots.end_time, time_slots.section, time_slots.subject_type FROM teachers INNER JOIN department_timetables ON teachers.teacher_id = department_timetables.teacher_id INNER JOIN time_slots ON time_slots.time_id = department_timetables.timeslots_id;


?>

</tbody>
</table>
</div>
</body>
</html>

