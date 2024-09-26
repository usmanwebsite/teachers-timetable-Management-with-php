<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers Timetable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .generate-btn {
            padding: 6px 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 3px;
            text-decoration: none;
            cursor: pointer;
        }
        .generate-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Teachers</h2>
    <table>
        <tr>
            <th>Teacher Name</th>
            <th>Action</th>
        </tr>
        <?php
        include 'connection.php'; 

        $query = "SELECT * FROM exact_teachers";
        $result = mysqli_query($conn, $query);

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['teachers'] . "</td>";
            echo "<td><a href='generate_timetable_teacher.php?id=" . $row['id'] . "' class='generate-btn'>Generate Timetable</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
