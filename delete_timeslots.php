<?php


include ("connection.php");

$id=$_GET['ti_id'];
echo $id;

 $query="DELETE  FROM time_slots WHERE time_id='$id' ";
 $execute= mysqli_query($conn,$query);

 if($execute){
   header("location: fetch_time.php?msg=1");
}else{
   header("location: fetch_time.php?msg=0");
}

?>

