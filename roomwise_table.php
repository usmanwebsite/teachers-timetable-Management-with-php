<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable by Room</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles */
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        table th {
            background-color: #f8f9fa;
        }
        table td.scheduled-class {
            background-color: #d1ecf1; /* Light blue background */
        }
        .room-name {
            margin-top: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Timetable by Room</h1>
        <?php
        include('connection.php');

        $time_query = "SELECT s_time, e_time FROM times ORDER BY id";
        $time_result = mysqli_query($conn, $time_query);
        $time_intervals = array();
        while ($row = mysqli_fetch_assoc($time_result)) {
            $time_intervals[] = array('start_time' => $row['s_time'], 'end_time' => $row['e_time']);
        }

        $days_query = "SELECT DISTINCT day_of_week FROM time_slots ORDER BY FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')";
        $days_result = mysqli_query($conn, $days_query);
        $days_of_week = array();
        while ($row = mysqli_fetch_assoc($days_result)) {
            $days_of_week[] = $row['day_of_week'];
        }

        $rooms_query = "SELECT DISTINCT class_no FROM classrooms ORDER BY class_no";
        $rooms_result = mysqli_query($conn, $rooms_query);

        $room_timetables = array();

        while ($room = mysqli_fetch_assoc($rooms_result)) {
            $room_no = $room['class_no'];
            $room_timetables[$room_no] = array_fill(0, count($days_of_week), array_fill(0, count($time_intervals), ''));
        }

        $room_schedule_query = "SELECT time_slots.day_of_week, time_slots.start_time, time_slots.end_time, 
                                  teachers.teacher_name, teachers.subject_title, time_slots.section, classrooms.class_no
                                  FROM department_timetables
                                  INNER JOIN time_slots ON department_timetables.timeslots_id = time_slots.time_id
                                  INNER JOIN teachers ON department_timetables.teacher_id = teachers.teacher_id
                                  INNER JOIN classrooms ON department_timetables.classrooms_id = classrooms.class_id";

        $room_schedule_result = mysqli_query($conn, $room_schedule_query);

        while ($row = mysqli_fetch_assoc($room_schedule_result)) {
            $day_index = array_search($row['day_of_week'], $days_of_week);
            $start_time_index = array_search($row['start_time'], array_column($time_intervals, 'start_time'));
            $end_time_index = array_search($row['end_time'], array_column($time_intervals, 'end_time'));

            $colspan = $end_time_index - $start_time_index == 1 ? 2 : 1;

            $room_timetables[$row['class_no']][$day_index][$start_time_index] = array(
                'colspan' => $colspan,
                'subject_name' => $row['subject_title'],
                'section_name' => $row['section'],
                'teacher_name' => $row['teacher_name'],
                'room_no' => $row['class_no']
            );

            if ($colspan == 2) {
                $room_timetables[$row['class_no']][$day_index][$start_time_index + 1] = '';
            }
        }

        foreach ($room_timetables as $room_no => $room_timetable) {
            echo '<h2 class="room-name">' . $room_no . '</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered">';
            echo '<thead class="thead-light"><tr><th></th>';
            foreach ($time_intervals as $interval) {
                echo '<th>' . $interval['start_time'] . '-' . $interval['end_time'] . '</th>';
            }
            echo '</tr></thead><tbody>';
            foreach ($room_timetable as $day_schedule_index => $day_schedule) {
                echo '<tr>';
                echo '<th>' . $days_of_week[$day_schedule_index] . '</th>';
                foreach ($day_schedule as $time_slot) {
                    if ($time_slot != '') {
                        echo '<td colspan="' . $time_slot['colspan'] . '" class="scheduled-class">' . 
                             'Subject: ' . $time_slot['subject_name'] . '<br>' . 
                             'Section: ' . $time_slot['section_name'] . '<br>' . 
                             'Teacher: ' . $time_slot['teacher_name'] . '<br>'.
                             'Room No: ' . $time_slot['room_no'] . 
                             '</td>';
                    } else {
                        echo '<td></td>';
                    }
                }
                echo '</tr>';
            }
            echo '</tbody></table></div>';
        }
        ?>
    </div>
    <!-- Include Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>