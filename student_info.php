<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
    <style>
        body {
            background-image: url('background.png');
            background-size: cover;
            background-attachment: fixed;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #87CEEB; /* Sky blue background color */
            color: black; /* Black text color */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: black; /* Black text color */
        }
        th {
            background-color: white; /* White background color */
        }
        .navbar {
            background-color: #87CEEB; /* Sky blue background color */
            width: 100%;
            padding: 20px 0; /* Increase the padding to make the navbar larger */
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: center; /* Center-align items */
            align-items: center; /* Center-align items */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar li {
            margin: 0 15px;
        }

        .navbar a {
            text-decoration: none;
            color: #000000; /* Black text color */
            font-weight: bold;
            font-size: 1.2em; /* Increase the font size */
            padding: 15px 20px; /* Increase padding around the links */
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 50px; /* Add top padding to raise the content */
            margin-top: 1.5px; /* Add margin-top to move the content below the navbar */
        }

        h2 {
            text-align: center; /* Align title to center */
            margin-top: 60px; /* Margin to push the title down from the navbar */
        }
    </style>
</head>
<body>
<div class="navbar">
        <ul>
            <li><a href="course.php">Course Management Form</a></li>
            <li><a href="showrecords.php">Records</a></li>
            <li><a href="student_info.php">Student Information</a></li>
            <li><a href="enrollment.php">Enrollment</a></li>
            <li><a href="report.php">Report</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Student Information</h2>
        <table>
            <tr>
                <th>Student Number</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Course</th>
                <th>Year</th>
            </tr>
            <?php
            // Include database connection file
            include_once 'connection.php';

            // Fetch student data from the database
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['student_no']."</td>";
                    echo "<td>".$row['lastname']."</td>";
                    echo "<td>".$row['firstname']."</td>";
                    echo "<td>".$row['middlename']."</td>";
                    echo "<td>".$row['gender']."</td>";
                    echo "<td>".$row['address']."</td>";
                    echo "<td>".$row['course']."</td>";
                    echo "<td>".$row['year']."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No student records found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
