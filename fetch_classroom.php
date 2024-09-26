<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <th>Class_id</th>
    <th>Class_no</th>
    <th>Class_type</th>
    <th>Stu.capacity</th>
    <th>Projector_Availbility</th>
    <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>



<?php
include ("connection.php");

$query= "SELECT * FROM classrooms";
$execute= mysqli_query($conn,$query);



  while( $record= mysqli_fetch_assoc($execute))
  {

    echo "
        <th>".$record['class_id']."</th> 
       <td>".$record['class_no']."</td>     
       <td>".$record['class_type']."</td>     
       <td>".$record['capacity']."</td>     
       <td>".$record['Projector_availble']."</td>     
       <td> <a  href='update_class.php?c_id=$record[class_id]'> <button> Edit </button></a></td>
       <td> <a href ='delete_class.php?c_id=$record[class_id]'><button> Delete  </button> </a></td> 

     </tr>

    ";
}
?>

</tbody>
</table>
</div>
</body>
</html>