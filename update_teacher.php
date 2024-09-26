<?php
include("connection.php");

$id = $_GET['te_id'];

$query = "SELECT * FROM teachers WHERE teacher_id='$id'";
$execute = mysqli_query($conn, $query);

$record = mysqli_fetch_assoc($execute);
 //print_r($record);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">

                <form action="" method="Post" class="row g-3 ">
                    <div class="mt-2 col-md-8">
                        <label for="">
                            <h3>Timetables_id</h3>
                        </label>
                        <input type="text" name="timetables_id" class="form-control" value="<?php echo $record['timetables_id']; ?>" placeholder="Enter classroom no" required>
                    </div>


                    <div class="mt-2 col-md-8">
                        <label for="">
                            <h3>Teacher Name</h3>
                        </label>
                        <input type="text" name="teacher_name" class="form-control" value="<?php echo $record['teacher_name']; ?>" placeholder="Enter teacher name" required>
                    </div>




                    <div class="col-md-8">
                        <label for="">
                            <h3>Email</h3>
                        </label>
                        <input type="text" class="form-control" name="email" value="<?php echo $record['email'] ?>" placeholder="Enter capacity">
                    </div>

                    <div class="col-md-8">
                        <label for="">
                            <h3>Contact #</h3>
                        </label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $record['phone'] ?>" placeholder="Enter capacity">
                    </div>


                    <div class="col-md-8">
                        <label for="">
                            <h3>Subject_Taught</h3>
                        </label>
                        <input type="text" class="form-control" name="subject_taught" value="<?php echo $record['subject_taught'] ?>" placeholder="Enter capacity">
                    </div>

                    <div class="col-md-8">
                        <label for="">
                            <h3>Subject_Title</h3>
                        </label>
                        <input type="text" class="form-control" name="subject_title" value="<?php echo $record['subject_title'] ?>" placeholder="Enter capacity">
                    </div>


                    <div class="row">
                        <div class="right">
                            <input type="submit" name="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>


                <?php
                if (isset($_POST['submit'])) {

                    $timetables_id = $_POST['timetables_id'];
                    $teacher_name = $_POST['teacher_name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $subject_taught = $_POST['subject_taught'];
                    $subject_title = $_POST['subject_title'];

                    $query = "UPDATE teachers SET  timetables_id='$timetables_id',teacher_name='$teacher_name',email='$email',phone='$phone',subject_taught='$subject_taught',subject_title ='$subject_title' WHERE teacher_id='$id' ";

                    $execute = mysqli_query($conn, $query);
                    if ($execute) {
                        header("location:fetch_teacher.php?msg1=1");
                    } else {
                        header("location:fetch_teacher.php?msg2=0");
                    }
                }

                ?>


            </div>
        </div>
    </div>
</body>

</html>