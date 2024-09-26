<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>
<style>
    .right {
        margin-left: 680px;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center">Teacher Insertion Form</h3>
            </div>
        </div>
        <div class="offset-md-2 card col-md-8 mt-5">


            <form action="insert_teacher.php" method="Post" class="offset-md-1">

            <?php
            include('connection.php');

            $query = "SELECT * from timetables";
            $run = mysqli_query($conn, $query);
            $rowcount = mysqli_num_rows($run);
            // print_r($rowcount);
            ?>
            <div class="col-md-8">
                <label for="inputAddress" class="form-label">
                    <h3>Teacher name</h3>
                </label>
                <select name="teacher_name" class="form-control mt-2">
                    <option value="">Select Teacher_name</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($run)) {
                        // print_r($row);
                    ?>
                        <option value="<?php echo $row['Teacher']; ?>" name="teacher"><?php echo $row['Teacher']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>



                <?php
                include('connection.php');

                $query = "SELECT * from timetables";
                $run = mysqli_query($conn, $query);
                $rowcount = mysqli_num_rows($run);
                // print_r($rowcount);
                ?>

                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>Course Code</h3>
                    </label>
                    <select name="course_code" class="form-control mt-2">
                        <option value="">Select Course_code</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($run)) {
                            // print_r($row);
                        ?>
                            <option value="<?php echo $row['id']; ?>" class="form-control" name="course_code"><?php echo $row['Course_code']; ?></option>
                        <?php
                        }


                        ?>
                    </select>
                </div>




                <div class="col-md-8">
                    <label for="">
                        <h3>Email</h3>
                    </label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                </div>

                <div class="col-md-8">
                    <label for="">
                        <h3>Phone</h3>
                    </label>
                    <input type="phone" class="form-control" name="phone" placeholder="Enter phone">
                </div>


                <?php
                include('connection.php');

                $query = "SELECT * from timetables";
                $run = mysqli_query($conn, $query);
                $rowcount = mysqli_num_rows($run);
                // print_r($rowcount);
                ?>
                <div class="col-md-8">
                    <label for="inputAddress" class="form-label">
                        <h3>Subject</h3>
                    </label>
                    <select name="subject" class="form-control mt-2">
                        <option value="">Select Subject</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($run)) {
                            // print_r($row);
                        ?>
                            <option value="<?php echo $row['Title']; ?>" name="subject"><?php echo $row['Title']; ?></option>
                        <?php
                        }


                        ?>
                    </select>

                </div>

                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>Subject Title</h3>
                    </label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Subject title" required>
                </div>


                <div class="row">
                    <div class="right">
                        <input type="submit" name="submit" class="btn btn-success">
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>

</html>