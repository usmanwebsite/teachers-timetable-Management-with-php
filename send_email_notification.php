<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


include('connection.php');

$currentTime = date('Y-m-d H:i:s');
var_dump($currentTime);
$tenMinutesLater = date('Y-m-d H:i:s', strtotime('+10 minutes', strtotime($currentTime)));
// var_dump($tenMinutesLater);

$query = "SELECT teachers.subject_title, time_slots.section, classrooms.class_no,classrooms.class_id, teachers.teacher_name, teachers.email 
 FROM department_timetables 
 INNER JOIN teachers ON department_timetables.teacher_id = teachers.teacher_id
 INNER JOIN time_slots ON department_timetables.timeslots_id = time_slots.time_id
 INNER JOIN classrooms ON department_timetables.classrooms_id = classrooms.class_id
 WHERE time_slots.start_time  BETWEEN '$currentTime' AND '$tenMinutesLater'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $classId = $row['class_id'];
        $subject = $row['subject_title'];
        $section = $row['section'];
        $roomNo = $row['class_no'];
        $teacherName = $row['teacher_name'];
        $teacherEmail = $row['email'];

        $message = "Mr. $teacherName,\n\n";
        $message .= "This is a reminder that your class for (Section: $section) and subject for $subject is scheduled to start in 10 minutes.\n";
        $message .= "Please proceed to. $roomNo.\n\n";
        $message .= "Best regards,\nGC University";

        // Send email notification
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'usmanghafoor869@gmail.com'; 
            $mail->Password = 'ozkrdjlzzunpzyfg'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('your-email@gmail.com', 'Department of Computer Science GCUF');
            $mail->addAddress($teacherEmail, $teacherName);

            $mail->isHTML(false);
            $mail->Subject = "Class Reminder: $subject (Section: $section)";
            $mail->Body = $message;

            // Send email
            $mail->send();
            echo "Email sent successfully to $teacherName ($teacherEmail) for class ID: $classId<br>";
        } catch (Exception $e) {
            echo "Error sending email to $teacherName ($teacherEmail) for class ID: $classId. Error: {$mail->ErrorInfo}<br>";
        }
    }
} else {
    echo "No classes scheduled to start in the next 10 minutes.";
}

mysqli_close($conn);



?>