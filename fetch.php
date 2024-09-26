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
<table class="table table-hover">
  <thead>
    <tr>
    <th>Id</th>
    <th>Department</th>
    <th>Type</th>
    <th>Semester</th>
    <th>Section</th>
    <th>Course Code</th>
    <th>Title</th>
    <th>Credit</th>
    <th>Class Hours</th>
    <th>Lab Hours</th>
    <th>Dept Subject</th>
    <th>Teacher</th>
    <th>Cell No</th>
    <th>Cnic</th>
    <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>



<?php
include ("connection.php");

$query= "SELECT * FROM timetables";
$execute= mysqli_query($conn,$query);



  while( $record= mysqli_fetch_assoc($execute))
  {

    echo "
        <th>".$record['id']."</th> 
       <td>".$record['Dept']."</td>     
       <td>".$record['Type']."</td>     
       <td>".$record['Semester']."</td>     
       <td>".$record['Section']."</td>     
       <td>".$record['Course_code']."</td>     
       <td>".$record['Title']."</td>     
       <td>".$record['Credit']."</td>  
       <td>".$record['Class_Hours']."</td>   
       <td>".$record['Lab_Hours']."</td>  
       <td>".$record['Dept_subj']."</td>  
       <td>".$record['Teacher']."</td>
       <td>".$record['cell_no']."</td> 
       <td>".$record['cnic']."</td>     
       <td> <a  href='update.php?t_id=$record[id]'> <button> Edit </button></a></td>
       <td> <a href ='delete.php?t_id=$record[id]&t_dept=$record[Dept]&t_type=$record[Type]&t_semester=$record[Semester]&t_section=$record[Section]&t_course=$record[Course_code]'><button> Delete  </button> </a></td> 

     </tr>

    ";
}
?>

</tbody>
</table>

</body>
</html>