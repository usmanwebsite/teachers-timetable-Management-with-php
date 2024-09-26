<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

        <form action="insert_department.php" method="post">

            <?php
            include('connection.php');

            $query = "SELECT * from timetables";
            $run = mysqli_query($conn, $query);
            $rowcount = mysqli_num_rows($run);
            // print_r($rowcount);
            ?>
            <div class="col-md-8">
                <label for="inputAddress" class="form-label">
                    <h3>Timetable</h3>
                </label>
                <select name="timetables" class="form-control mt-2">
                    <option value="">Select Timetable</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($run)) {
                        // print_r($row);
                    ?>
                        <option value="<?php echo $row['id']; ?>" ><?php echo $row['Course_code']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>

            <?php
            include('connection.php');

            $query = "SELECT * from classrooms";
            $run = mysqli_query($conn, $query);
            $rowcount = mysqli_num_rows($run);
            // print_r($rowcount);
            ?>
            <div class="col-md-8">
                <label for="inputAddress" class="form-label">
                    <h3>class</h3>
                </label>
                <select name="classrooms" class="form-control mt-2">
                    <option value="">Select class</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($run)) {
                        // print_r($row);
                    ?>
                        <option value="<?php echo $row['class_id']; ?>" ><?php echo 'Room No. ' . $row['class_no']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>

            <?php
            include('connection.php');

            $query = "SELECT * from teachers";
            $run = mysqli_query($conn, $query);
            $rowcount = mysqli_num_rows($run);
            // print_r($rowcount);
            ?>
            <div class="col-md-8">
                <label for="inputAddress" class="form-label">
                    <h3>Teacher name</h3>
                </label>
                <select name="teachers" class="form-control mt-2">
                    <option value="">Select Teacher_name</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($run)) {
                        // print_r($row);
                    ?>
                        <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['teacher_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>







            <?php
            include('connection.php');

            $query = "SELECT * from exact_teachers";
            $run = mysqli_query($conn, $query);
            $rowcount = mysqli_num_rows($run);
            // print_r($rowcount);
            ?>
            <div class="col-md-8">
                <label for="inputAddress" class="form-label">
                    <h3>Again Teacher name</h3>
                </label>
                <select name="exact_teachers" class="form-control mt-2">
                    <option value="">Select Teacher_name</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($run)) {
                        // print_r($row);
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['teachers']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>












            <?php
            include('connection.php');

            $query = "SELECT * from time_slots";
            $run = mysqli_query($conn, $query);
            $rowcount = mysqli_num_rows($run);
            // print_r($rowcount);
            ?>
            <div class="col-md-8">
                <label for="inputAddress" class="form-label">
                    <h3>Time slots</h3>
                </label>
                <select name="timeslots" class="form-control mt-2">
                    <option value="">Select Time</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($run)) {
                        // print_r($row);
                    ?>
                        <option value="<?php echo $row['time_id']; ?>"><?php echo $row['start_time'].'---'.$row['end_time']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>

            <div class="col-md-8">
                    <label for="">
                        <h3>Timetable_For</h3>
                    </label>
                    <select name="timetable_type" class="form-control mt-2">
                        <option value="">Select Subject Type</option>
                            <option value="Morning" class="form-control" >Morning</option>
                            <option value="Raplica" class="form-control" >Raplica</option>
                            <option value="Bridging" class="form-control" >Bridging</option>
                            <option value="Summer" class="form-control" >Summer</option>
                    </select>
                </div>


                <input type="submit" name="submit" class="btn btn-info mt-3 "> 


        </form>

    </div>
</body>

</html>