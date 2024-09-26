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
                <h3 class="text-center">Classroom Insertion Form</h3>
            </div>
        </div>
        <div class="offset-md-2 card col-md-8 mt-5">


            <form action="insert_classroom.php" method="Post" class="offset-md-1">
                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>classroom No.</h3>
                    </label>
                    <input type="text" name="class_no" class="form-control" placeholder="Enter classroom no" required>
                </div>


                <div class="mt-2 col-md-8">
                    <label for="">
                        <h3>Classroom Type</h3>
                    </label>
                    <select name="class_type" class="form-control mt-2">
                        <option value="">Select Course_type</option>
                            <option value="Class" class="form-control" >Class</option>
                            <option value="Lab" class="form-control" >Lab</option>
                            <option value="Seminar_hall" class="form-control" >Seminar_hall</option>
                    </select>
                </div>




                <div class="col-md-8">
                    <label for="">
                        <h3>Class Capacity</h3>
                    </label>
                    <input type="text" class="form-control" name="capacity" placeholder="Enter capacity">
                </div>

                <div class="col-md-8">
                    <label for="">
                        <h3>Projector_available</h3>
                    </label>
                    <select name="projector" class="form-control mt-2">
                        <option value="">Select Projector Availbilty</option>
                            <option value="Yes" class="form-control" >Yes</option>
                            <option value="No" class="form-control" >No</option>
                    </select>
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