<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Teacher</title>
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
    <th>Teacher_id</th>
    <th>Timetables_id</th>
    <th>Teacher_name</th>
    <th>Email</th>
    <th>Contact#</th>
    <th>Subject_Taught</th>
    <th>Subject_Title</th>
    <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>



<?php
include ("connection.php");

$query= "SELECT * FROM teachers";
$execute= mysqli_query($conn,$query);



  while( $record= mysqli_fetch_assoc($execute))
  {

    echo "
        <th>".$record['teacher_id']."</th> 
       <td>".$record['timetables_id']."</td>     
       <td>".$record['teacher_name']."</td>     
       <td>".$record['email']."</td>
       <td>".$record['phone']."</td>     
       <td>".$record['subject_taught']."</td>  
       <td>".$record['subject_title']."</td>     
       <td> <a  href='update_teacher.php?te_id=$record[teacher_id]'> <button> Edit </button></a></td>
       <td> <a href ='delete_teacher.php?te_id=$record[teacher_id]'><button> Delete  </button> </a></td> 

     </tr>

    ";
}
?>

</tbody>
</table>
</div>
</body>
</html>