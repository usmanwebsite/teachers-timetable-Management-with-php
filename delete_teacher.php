<?php


include ("connection.php");

$id=$_GET['te_id'];
echo $id;

 $query="DELETE  FROM teachers WHERE teacher_id='$id' ";
 $execute= mysqli_query($conn,$query);

 if($execute){
   header("location: fetch_teacher.php?msg=1");
}else{
   header("location: fetch_teacher.php?msg=0");
}

?>

