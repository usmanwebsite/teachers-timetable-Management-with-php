<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import File</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">

<?php  
if(isset($_SESSION['message']))
{
    echo "<h2>".$_SESSION['message']."</h2>";
    unset($_SESSION['message']);
}
?>
 

 <div class="card">
  <div class="card-header">
    <h1>Timetable for Lectures</h1>
  </div>
  <div class="card-body">

  <form action="insert.php" method="post" enctype="multipart/form-data">

<div class="row mt-3">
    <div class="col">
        <input type="file" name="import_file" class="form-control">
    </div>
</div>
<br>

<div class="row mt-3">
    <div class="col">
        <input type="submit" class="btn btn-primary" name="save_excel_files" value="Import file">
    </div>
</div>

</form>

  </div>
</div>


</div>



</body>
</html>