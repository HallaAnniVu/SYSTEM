<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Info</title>
    <style>
        body {
            background-image: url('background.png');
            background-size: cover;
            background-attachment: fixed;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            font-family: Arial, sans-serif;
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

        h2 {
            text-align: center;
            color: #000; /* Black font color */
            margin-top: 100px; /* Margin to push the title down from the navbar */
            font-weight: bold; /* Bold text */
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white; /* Set table background to white */
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: white; /* Header background color */
        }

        td {
            background-color: #87CEEB; /* Sky blue background color for data cells */
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9; /* Lighter blue for even rows */
        }

        tr:hover td {
            background-color: #f2f2f2; /* Hover effect for rows */
        }

        .button {
            display: inline-block;
            padding: 8px 16px;
            margin: 4px 2px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button-delete {
            background-color: #f44336;
        }

        .button-delete:hover {
            background-color: #d32f2f;
        }

        .container {
            background-color: white; /* Container background color */
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
        }

        /* Search Form Styles */
        form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        button[type="submit"] {
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
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

    <h2>Enrollment Records</h2>

    <div class="container">
        <!-- Search Form -->
        <form method="get" action="search.php">
            <input type="
            text" name="search" placeholder="Search existing records">
<button type="submit">Search</button>
</form>
<table>
        <tr>
            <th>Student Id</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Course</th>
            <th>Year</th>
            <th>Download</th>
            <th>Delete</th>
        </tr>
        <?php
        // Include your database connection file
        include 'connection.php';

        // Fetch records from the enrolment_form table
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);

        // Check if there are any records
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<td>" . $row["student_no"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["middlename"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["course"] . "</td>";
                echo "<td>" . $row["year"] . "</td>";
                echo "<td><a href='download.php?id=" . $row["id"] . "' class='button'>Download</a></td>";
                echo "<td><a href='deletereport.php?id=" . $row["id"] . "' class='button button-delete'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No records found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
</div>
</body>
</html>
