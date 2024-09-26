<?php

$conn =mysqli_connect('localhost','root','','timetable_fyp')or die("Connection not estabilished");

// // SELECT teachers.teacher_name, time_slots.section, classrooms.class_no ,time_slots.start_time ,time_slots.end_time
// FROM department_timetables
// INNER JOIN time_slots ON department_timetables.timeslots_id = time_slots.time_id 
// INNER JOIN teachers ON department_timetables.teacher_id = teachers.teacher_id 
// INNER JOIN classrooms ON department_timetables.classrooms_id = classrooms.class_id
// WHERE time_slots.day_of_week = 'Wednesday' AND time_slots.start_time = '02:00' AND time_slots.end_time = '04:00'
?>