<?php
include("connection.php");

$id = $_GET['c_id'];

$query = "SELECT * FROM classrooms WHERE class_id='$id'";
$execute = mysqli_query($conn, $query);

$record = mysqli_fetch_assoc($execute);
//  print_r($record);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Class</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">

                <form action="" method="Post" class="row g-3 ">
                    <div class="mt-2 col-md-8">
                        <label for="">
                            <h3>classroom No.</h3>
                        </label>
                        <input type="text" name="class_no" class="form-control" value="<?php echo $record['class_no']; ?>" placeholder="Enter classroom no" required>
                    </div>


                    <div class="mt-2 col-md-8">
                        <label for="">
                            <h3>Classroom Type</h3>
                        </label>
                        <select name="class_type" class="form-control mt-2" >
                            <option value="" >Select Course_type</option> 
                            <option value="Class" <?php if ($record['class_type'] == 'Class') echo 'selected="selected"'; ?>>Class</option>
                            <option value="Lab" <?php if ($record['class_type'] == 'Lab') echo 'selected="selected"'; ?>>Lab</option>
                            <option value="seminar_hall" <?php if ($record['class_type'] == 'seminar_hall') echo 'selected="selected"'; ?>>Seminar_hall</option>
                        </select>
                    </div>




                    <div class="col-md-8">
                        <label for="">
                            <h3>Class Capacity</h3>
                        </label>
                        <input type="text" class="form-control" name="capacity" value="<?php echo $record['capacity'] ?>" placeholder="Enter capacity">
                    </div>

                    <div class="col-md-8">
                        <label for="">
                            <h3>Projector_available</h3>
                        </label>
                        <select name="projector" class="form-control mt-2">
                            <option value="">Select Projector Availbilty</option>
                            <option value="Yes" <?php if ($record['Projector_availble'] == 'Yes') echo 'selected="selected"'; ?> class="form-control">Yes</option>
                            <option value="No" <?php if ($record['Projector_availble'] == 'No') echo 'selected="selected"'; ?> class="form-control">No</option>
                        </select>
                    </div>



                    <div class="row">
                        <div class="right">
                            <input type="submit" name="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>


                <?php
                if (isset($_POST['submit'])) {

                    $class_no = $_POST['class_no'];
                    $class_type = $_POST['class_type'];
                    $capacity = $_POST['capacity'];
                    $projector = $_POST['projector'];

                    $query = "UPDATE classrooms SET  class_no='$class_no',class_type='$class_type',capacity='$capacity',Projector_availble='$projector' WHERE class_id='$id' ";

                    $execute = mysqli_query($conn, $query);
                    if ($execute) {
                        header("location:fetch_classroom.php?msg1=1");
                    } else {
                        header("location:fetch_classroom.php?msg2=0");
                    }
                }

                ?>


            </div>
        </div>
    </div>
</body>

</html>