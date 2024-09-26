<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable for Teacher</title>
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
        .teacher-name {
            margin-top: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Timetable for Teacher</h1>
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

        $teachers_query = "SELECT DISTINCT teacher_id, teacher_name FROM teachers";
        $teachers_result = mysqli_query($conn, $teachers_query);

        $teacher_timetables = array();

        while ($teacher = mysqli_fetch_assoc($teachers_result)) {
            $teacher_id = $teacher['teacher_id'];
            $teacher_name = $teacher['teacher_name'];

            $existing_timetable_key = array_search($teacher_name, array_column($teacher_timetables, 'teacher_name'));
            if ($existing_timetable_key !== false) {
                $timetable_key = $existing_timetable_key;
            } else {
                $timetable_key = count($teacher_timetables);
                $teacher_timetables[$timetable_key] = array(
                    'teacher_name' => $teacher_name,
                    'schedule' => array_fill(0, count($days_of_week), array_fill(0, count($time_intervals), ''))
                );
            }

            $teacher_schedule_query = "SELECT time_slots.day_of_week, time_slots.start_time, time_slots.end_time, teachers.teacher_name, classrooms.class_no, time_slots.section
            FROM department_timetables
            INNER JOIN time_slots ON department_timetables.timeslots_id = time_slots.time_id
            INNER JOIN teachers ON department_timetables.teacher_id = teachers.teacher_id
            INNER JOIN classrooms ON department_timetables.classrooms_id = classrooms.class_id
            WHERE department_timetables.teacher_id = $teacher_id";
            $teacher_schedule_result = mysqli_query($conn, $teacher_schedule_query);

            while ($row = mysqli_fetch_assoc($teacher_schedule_result)) {
                $day_index = array_search($row['day_of_week'], $days_of_week);
                $start_time_index = array_search($row['start_time'], array_column($time_intervals, 'start_time'));
                $end_time_index = array_search($row['end_time'], array_column($time_intervals, 'end_time'));

                $colspan = $end_time_index - $start_time_index == 1 ? 2 : 1;

                $teacher_timetables[$timetable_key]['schedule'][$day_index][$start_time_index] = array(
                    'colspan' => $colspan,
                    'class_info' => $row['teacher_name'] . '<br>' . $row['class_no'] . '<span>' . $row['section'] . '</span>'
                );

                if ($colspan == 2) {
                    $teacher_timetables[$timetable_key]['schedule'][$day_index][$start_time_index + 1] = '';
                }
            }
        }

        foreach ($teacher_timetables as $timetable) {
            $isEmpty = true;
            foreach ($timetable['schedule'] as $day_schedule) {
                foreach ($day_schedule as $time_slot) {
                    if (!empty($time_slot)) {
                        $isEmpty = false;
                        break 2;
                    }
                }
            }

            if ($isEmpty) {
                continue;
            }

            echo '<h2 class="teacher-name">' . $timetable['teacher_name'] . '</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered">';
            echo '<thead class="thead-light"><tr><th></th>';
            foreach ($time_intervals as $interval) {
                echo '<th>' . $interval['start_time'] . '-' . $interval['end_time'] . '</th>';
            }
            echo '</tr></thead><tbody>';
            foreach ($timetable['schedule'] as $day_schedule_index => $day_schedule) {
                $isEmptyRow = true;
                foreach ($day_schedule as $time_slot) {
                    if (!empty($time_slot)) {
                        $isEmptyRow = false;
                        break;
                    }
                }

                if (!$isEmptyRow) {
                    echo '<tr>';
                    echo '<th>' . $days_of_week[$day_schedule_index] . '</th>';
                    foreach ($day_schedule as $time_slot) {
                        if ($time_slot != '') {
                            echo '<td colspan="' . $time_slot['colspan'] .  '" class="scheduled-class" >' . $time_slot['class_info'] .  '</td>';
                        } else {
                            echo '<td></td>';
                        }
                    }
                    echo '</tr>';
                }
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
