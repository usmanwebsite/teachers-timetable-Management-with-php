<?php
include ("connection.php");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$id=$_GET['t_id'];
$dept=$_GET['t_dept'];
$type=$_GET['t_type'];
$semester = $_GET['t_semester'];
$section = $_GET['t_section'];
$courseCode = $_GET['t_course'];

$query = "DELETE  FROM timetables WHERE id='$id' ";

$execute = mysqli_query($conn,$query);

if ($execute) {
    // Load Excel file
    $inputfilenamepath = 'D:/xampp/htdocs/Timetable_fyp/uploads/Spring24_CourseAllocation_Bs_Project.xls';
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputfilenamepath);

    // Get active sheet
    $sheet = $spreadsheet->getActiveSheet();

    $highestRow = $sheet->getHighestRow();

    for ($row = 1; $row <= $highestRow; ++$row) {
        $rowValues = $sheet->rangeToArray('A' . $row . ':Z' . $row, NULL, TRUE, FALSE)[0];

        if (
            $rowValues[0] == $dept &&
            $rowValues[1] == $type &&
            $rowValues[2] == $semester &&
            $rowValues[3] == $section &&
            $rowValues[4] == $courseCode
        ) {
            // Delete the row from the Excel sheet
            $sheet->removeRow($row);
            break;
        }
    }

    // Save changes to Excel file
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save($inputfilenamepath);

    echo "Record Deleted Successfully";
} else {
    echo "Error deleting record from database: " . mysqli_error($con);
}
?>