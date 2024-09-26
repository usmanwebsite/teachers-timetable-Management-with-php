<?php
session_start();

include('connection.php');
require('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST["save_excel_files"])) {
    $filename = $_FILES['import_file']['name'];
    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

    $allowed_txt = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_txt)) {
        $inputfilenamepath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputfilenamepath);

        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "1";

        foreach ($data as $count => $row) {
            if ($count > 0 ) {
                $dept = $row['0'];
                $type = $row['1'];
                $semester = $row['2'];
                $section = $row['3'];
                $course_code = $row['4'];
                $title = $row['5'];
                $credit = $row['6'];
                $class_hours = $row['7'];
                $lab_hours = $row['8'];
                $dept_subject = $row['9'];
                $teacher = $row['10'];
                $cell = $row['11'];
                $cnic = $row['12'];

                // Check if the record exists
                $checkQuery = "SELECT * FROM timetables WHERE Course_Code = '$course_code'";
                $stmt = mysqli_query($conn, $checkQuery);

                if (mysqli_num_rows($stmt) > 0) {
                    // Record exists, update it
                    $updateQuery = "UPDATE timetables SET Dept ='$dept', Type ='$type', Semester ='$semester', Section ='$section', Title ='$title', Credit ='$credit', Class_Hours ='$class_hours', Lab_Hours ='$lab_hours', Dept_subj ='$dept_subject', Teacher ='$teacher', cell_no ='$cell', cnic ='$cnic' WHERE Course_Code ='$course_code'";
                    $stmt = mysqli_query($conn, $updateQuery);
                } else {
                    // Record doesn't exist, insert it
                    $insertQuery = "INSERT INTO timetables (Dept, Type, Semester, Section, Course_Code, Title, Credit, Class_Hours, Lab_Hours, Dept_subj, Teacher, cell_no, cnic) VALUES ('$dept', '$type','$semester','$section','$course_code','$title', '$credit','$class_hours','$lab_hours','$dept_subject','$teacher','$cell','$cnic')";
                    $stmt = mysqli_query($conn, $insertQuery);
                }
            } else {
                $count = '1';
            }
        }

        $_SESSION['message'] = "File Added Successfully";
        header('location: index.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Invalid file Attached";
        header('location: index.php');
        exit(0);
    }
}
?>
