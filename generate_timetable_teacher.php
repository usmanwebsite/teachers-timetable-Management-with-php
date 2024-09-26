<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $teacher_id = $_GET['id'];

    $teacher_query = "SELECT * FROM exact_teachers WHERE id = $teacher_id";
    $teacher_result = $conn->query($teacher_query);
    if (!$teacher_result) {
        die("Query Failed: " . $conn->error);
    }

    $teacher = $teacher_result->fetch_assoc();
    if (!$teacher) {
        die("No teacher found with ID: " . $teacher_id);
    }

    $timetable_query = "
    SELECT 
        timetables.Course_Code, 
        timetables.Semester,
        timetables.Title, 
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
    if (!$timetable_result) {
        die("Query Failed: " . $conn->error);
    }

    echo "<h2>Timetable for " . $teacher['teachers'] . "</h2>";
    echo "<table border='1'>
    <tr>
    <th>Day</th>
    <th>Course Code</th>
    <th>Title</th>
    <th>Section</th>
    <th>Classroom</th>
    <th>Start Time</th>
    <th>End Time</th>
    </tr>";

    $count = 0;
    while ($row = $timetable_result->fetch_assoc()) {
        $count++;
        echo "<tr>
        <td>" . $row['day_of_week'] . "</td>
        <td>" . $row['Course_Code'] . "</td>
        <td>" . $row['Title'] . "</td>
        <td>" . $row['section'] . "</td>
        <td>" . $row['class_no'] . "</td>
        <td>" . $row['start_time'] . "</td>
        <td>" . $row['end_time'] . "</td>
        </tr>";
    }

    echo "</table>";
    echo "<p>Total records: $count</p>";
    echo "<a href='generate_pdf.php?teacher_id=$teacher_id'>Download PDF</a>";
} else {
    echo "Teacher ID is not specified.";
}
?>
