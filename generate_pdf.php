<?php
require('vendor/autoload.php');
include 'connection.php'; // Include your database connection script

$teacher_id = $_GET['teacher_id'];

$teacher_query = "SELECT * FROM exact_teachers WHERE id = $teacher_id";
$teacher_result = $conn->query($teacher_query);
$teacher = $teacher_result->fetch_assoc();

// Fetch timetable details
$timetable_query = "
SELECT 
        timetables.Course_Code, 
        timetables.Semester, 
        classrooms.class_no, 
        time_slots.day_of_week, 
        time_slots.start_time, 
        time_slots.section,
        time_slots.end_time
    FROM 
        department_timetables
    JOIN 
        timetables ON department_timetables.timetables_id = timetables.id
    JOIN 
        classrooms ON department_timetables.classrooms_id = classrooms.class_id
    JOIN 
        time_slots ON department_timetables.timeslots_id = time_slots.time_id
    WHERE 
        department_timetables.exact_teachers = '$teacher_id'
    ORDER BY 
        time_slots.day_of_week, time_slots.start_time
";
$timetable_result = $conn->query($timetable_query);

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 10, "Timetable for " . $teacher['teachers'], 0, 1, 'C');
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'Day', 1);
$pdf->Cell(30, 10, 'Course Code', 1);
$pdf->Cell(30, 10, 'Section', 1);
$pdf->Cell(30, 10, 'Classroom', 1);
$pdf->Cell(30, 10, 'Start Time', 1);
$pdf->Cell(30, 10, 'End Time', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
while ($row = $timetable_result->fetch_assoc()) {
    $pdf->Cell(20, 10, $row['day_of_week'], 1);
    $pdf->Cell(30, 10, $row['Course_Code'], 1);
    $pdf->Cell(30, 10, $row['section'], 1);
    $pdf->Cell(30, 10, $row['class_no'], 1);
    $pdf->Cell(30, 10, $row['start_time'], 1);
    $pdf->Cell(30, 10, $row['end_time'], 1);
    $pdf->Ln();
}

$pdf->Output('D', 'Timetable_' . $teacher['teachers'] . '.pdf');
?>
