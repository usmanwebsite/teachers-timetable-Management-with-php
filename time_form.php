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
                <h3 class="text-center">Time Slots Form</h3>
            </div>
        </div>
        <div class="offset-md-2 card col-md-8 mt-5">


            <form action="insert_time.php" method="Post" class="offset-md-1">
                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>Day of Week</h3>
                    </label>
                    <input type="text" name="week" class="form-control" placeholder="Enter Week" required>
                </div>


                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>Start_Time</h3>
                    </label>
                    <input type="time" name="s_time" class="form-control" required>
                </div>


                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>End_Time</h3>
                    </label>
                    <input type="time" name="e_time" class="form-control" required>
                </div>

                <div class="col-md-8">
                    <label for="">
                        <h3>Subject_Type</h3>
                    </label>
                    <select name="subject_type" class="form-control mt-2">
                        <option value="">Select Subject Type</option>
                            <option value="lecture" class="form-control" >lecture</option>
                            <option value="lab" class="form-control" >lab</option>
                            <option value="exam" class="form-control" >exam</option>
                            <option value="practical" class="form-control" >practical</option>
                    </select>
                </div>


               
                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>Section</h3>
                    </label>
                    <input type="text" name="section" class="form-control" placeholder="Enter Section" required>
                </div>



                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>Is_Exam</h3>
                    </label>
                    <input type="Boolean" name="is_exam" class="form-control" value="0"  readonly required>
                </div>


                <div class="row mt-1">
                    <div class="right">
                        <input type="submit" name="submit" class="btn btn-success">
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>

</html>