<?php
include("connection.php");

$id = $_GET['ti_id'];

$query = "SELECT * FROM time_slots WHERE time_id='$id'";
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
    <title>Update time_slots</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">

                <form action="" method="Post" class="row g-3 ">
                    <div class="mt-2 col-md-8">
                        <label for="">
                            <h3>day_of_week</h3>
                        </label>
                        <input type="text" name="day_of_week" class="form-control" value="<?php echo $record['day_of_week']; ?>" placeholder="Enter classroom no" required>
                    </div>


                    <div class="mt-2 col-md-8">
                        <label for="">
                            <h3>start_time</h3>
                        </label>
                        <input type="text" name="start_time" class="form-control" value="<?php echo $record['start_time']; ?>" required>
                    </div>




                    <div class="col-md-8">
                        <label for="">
                            <h3>end_time</h3>
                        </label>
                        <input type="text" class="form-control" name="end_time" value="<?php echo $record['end_time'] ?>" placeholder="Enter capacity">
                    </div>

                    <div class="col-md-8">
                        <label for="">
                            <h3>subject_type</h3>
                        </label>
                        <select name="subject_type" class="form-control mt-2">
                            <option value="">Select subject_type</option>
                            <option value="lecture" <?php if ($record['subject_type'] == 'lecture') echo 'selected="selected"'; ?> class="form-control">lecture</option>
                            <option value="lab" <?php if ($record['subject_type'] == 'lab') echo 'selected="selected"'; ?> class="form-control">lab</option>
                            <option value="exam" <?php if ($record['subject_type'] == 'exam') echo 'selected="selected"'; ?> class="form-control">exam</option>
                            <option value="practical" <?php if ($record['subject_type'] == 'practical') echo 'selected="selected"'; ?> class="form-control">practical</option>
                        </select>
                    </div>


                    <div class="col-md-8">
                        <label for="">
                            <h3>Is_Exam</h3>
                        </label>
                        <input type="text" class="form-control" name="is_exam" value="<?php echo $record['is_exam'] ?>" readonly>
                    </div>



                    <div class="row">
                        <div class="right">
                            <input type="submit" name="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>


                <?php
                if (isset($_POST['submit'])) {

                    $day_of_week = $_POST['day_of_week'];
                    $start_time = $_POST['start_time'];
                    $end_time = $_POST['end_time'];
                    $subject_type = $_POST['subject_type'];
                    $is_exam = $_POST['is_exam'];

                    $query = "UPDATE time_slots SET  day_of_week='$day_of_week',start_time='$start_time',end_time='$end_time',subject_type='$subject_type',is_exam='$is_exam' WHERE time_id='$id' ";

                    $execute = mysqli_query($conn, $query);
                    if ($execute) {
                        header("location:fetch_time.php?msg1=1");
                    } else {
                        header("location:fetch_time.php?msg2=0");
                    }
                }

                ?>


            </div>
        </div>
    </div>
</body>

</html>