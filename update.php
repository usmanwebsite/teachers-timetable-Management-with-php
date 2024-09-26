<?php
include("connection.php");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$id = $_GET['t_id'];
//  echo $id;

$query = "SELECT * FROM timetables WHERE id='$id'";
$execute = mysqli_query($conn, $query);

$record = mysqli_fetch_assoc($execute);


if (isset($_POST['submit'])) {

    $dept = $_POST['dept'];
    $type = $_POST['type'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $course_code = $_POST['course'];
    $title = $_POST['title'];
    $credit = $_POST['credit'];
    $class_hours = $_POST['class_hours'];
    $lab_hours = $_POST['lab_hours'];
    $dept_subj = $_POST['dept_subj'];
    $teacher = $_POST['teacher'];
    $cell_no = $_POST['cell_no'];
    //var_dump($cell_no);
    $cnic = $_POST['cnic'];

    $query = "UPDATE timetables SET  Dept='$dept',Type='$type',Semester='$semester',Section='$section',Course_code='$course_code',Title='$title',Credit='$credit',Class_Hours='$class_hours',Lab_Hours='$lab_hours',Dept_subj='$dept_subj',Teacher='$teacher',cell_no='$cell_no',cnic='$cnic'  WHERE id='$id' ";

    $execute = mysqli_query($conn, $query);


    $excelFilePath = 'D:/xampp/htdocs/Timetable_fyp/uploads/Spring24_CourseAllocation_Bs_Project.xls';
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelFilePath);
    $worksheet = $spreadsheet->getActiveSheet();

    // Function to find row number based on criteria
    function findRowNumberByCriteria($worksheet, $criteria)
    {
        foreach ($worksheet->getRowIterator() as $rowNumber => $row) {
            if ($worksheet->getCell('E' . $rowNumber)->getValue() == $criteria) {
                return $rowNumber;
            }
        }
        return false;
    }

    $criteria = $record['Course_code'];
    print_r($criteria);
    $rowNumber = findRowNumberByCriteria($worksheet, $criteria);

    if ($rowNumber !== false) {

        $dataToUpdate = array(
            'dept' => $record['Dept'],
            'type' => $record['Type'],
            'semester' => $record['Semester'],
            'section' => $record['Section'],
            'course' => $record['Course_code'],
            'title' => $record['Title'],
            'credit' => $record['Credit'],
            'class_hours' => $record['Class_Hours'],
            'lab_hours' => $record['Lab_Hours'],
            'dept_subj' => $record['Dept_subj'],
            'teacher' => $record['Teacher'],
            'cell_no' => $record['cell_no'],
            'cnic' => $record['cnic'],
        );

        function updateExcelRow($worksheet, $rowNumber, $data)
        {
            $columnMapping = array(
                'dept' => 'A',
                'type' => 'B',
                'semester' => 'C',
                'section' => 'D',
                'course' => 'E',
                'title' => 'F',
                'credit' => 'G',
                'class_hours' => 'H',
                'lab_hours' => 'I',
                'dept_subj' => 'J',
                'teacher' => 'K',
                'cell' => 'L',
                'cnic' => 'M',
            );

            foreach ($columnMapping as $column => $excelColumn) {
                $value = isset($data[$column]) ? $data[$column] : '';
                $worksheet->setCellValue($excelColumn . $rowNumber, $value);
            }
        }

        updateExcelRow($worksheet, $rowNumber, $dataToUpdate);

        $tempExcelFilePath = 'D:/xampp/htdocs/Timetable_fyp/uploads/Spring24_CourseAllocation_Bs_Project_temp.xls';
        $excelWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $excelWriter->save($tempExcelFilePath);

        if (copy($tempExcelFilePath, $excelFilePath)) {
            unlink($tempExcelFilePath);
            header("location:fetch.php?msg1=1");
            exit();
        } else {
            echo "Error updating Excel file.";
        }
    } else {
        echo "Error: Row not found in the Excel sheet.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">

                <h1 class="text-center">Update Timetable</h1>

                <form action="" method="Post" class="row g-3 ">
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Department</label>
                        <input type="text" name="dept" value="<?php echo $record['Dept']; ?>" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Type</label>
                        <input type="text" name="type" value="<?php echo $record['Type']; ?>" class="form-control" id="inputPassword4">
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Semester</label>
                        <input type="text" class="form-control" value="<?php echo $record['Semester']; ?>" name="semester">
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Section</label>
                        <input type="text" class="form-control" value="<?php echo $record['Section']; ?>" name="section">
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Course_code</label>
                            <input type="text" value="<?php echo $record['Course_code']; ?>" name="course" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Title</label>
                            <input type="text" value="<?php echo $record['Title']; ?>" name="title" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Credit</label>
                            <input type="text" value="<?php echo $record['Credit']; ?>" name="credit" class="form-control">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Class_Hours</label>
                            <input type="text" value="<?php echo $record['Class_Hours']; ?>" name="class_hours" class="form-control">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Lab_Hours</label>
                            <input type="text" value="<?php echo $record['Lab_Hours']; ?>" name="lab_hours" class="form-control">
                        </div>
                    </div>




                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Dept_subj</label>
                            <input type="text" value="<?php echo $record['Dept_subj']; ?>" name="dept_subj" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Teacher</label>
                            <input type="text" value="<?php echo $record['Teacher']; ?>" name="teacher" class="form-control">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Cell No.</label>
                            <input type="text" value="<?php echo $record['cell_no']; ?>" name="cell_no" class="form-control">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label">Cnic</label>
                            <input type="text" value="<?php echo $record['cnic']; ?>" name="cnic" class="form-control">
                        </div>
                    </div>


                    <input type="submit" name="submit" value="Update" class="btn btn-primary">

                </form>



            </div>
        </div>
    </div>
</body>

</html>