<?php


include ("connection.php");

$id=$_GET['c_id'];
echo $id;

 $query="DELETE  FROM classrooms WHERE class_id='$id' ";
 $execute= mysqli_query($conn,$query);

 if($execute){
   header("location: fetch_classroom.php?msg=1");
}else{
   header("location: fetch_classroom.php?msg=0");
}

?>

