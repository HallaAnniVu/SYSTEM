<?php
session_start();
if (isset($_SESSION["signup_info"])) {
    header("Location: delete.php");
    exit();
}

include_once 'connection.php';

// Function to fetch records from the database
function fetchRecords($conn) {
    $sql = "SELECT * FROM courses";
    $result = mysqli_query($conn, $sql);
    $records = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }
    }
    return $records;
}

// Fetch records from the database
$records = fetchRecords($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Records</title>
    <script>
        window.onload = function() {
            <?php
            if (isset($_SESSION['notification'])) {
                echo "alert('" . $_SESSION['notification'] . "');";
                unset($_SESSION['notification']); // Clear the notification after displaying it
            }
            ?>
        };

        // Function to handle search functionality
        function searchCourse() {
            // Retrieve search input value
            var searchValue = document.getElementById("searchInput").value.trim();

            // If search value is not empty, redirect to search.php with search query parameter
            if (searchValue !== "") {
                window.location.href = "search.php?query=" + encodeURIComponent(searchValue);
            }
        }

        // Function to toggle edit form visibility
        function toggleEditForm(id) {
            var editFormRow = document.getElementById('editFormRow_' + id);
            if (editFormRow.style.display === 'none') {
                editFormRow.style.display = 'table-row';
            } else {
                editFormRow.style.display = 'none';
            }
        }
    </script>
    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
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
            color: black;
            font-weight: bold;
            margin-top: 70px; /* Ensure space below the fixed navbar */
        }

        table {
            width: 100%; /* Full width */
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #87CEEB; /* Sky blue background color */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: white; /* Header background color */
        }

        td {
            background-color: #87CEEB; /* Sky blue background color for data cells */
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2; /* Lighter blue for even rows */
        }

        tr:hover td {
            background-color: #f2f2f2; /* Hover effect for rows */
        }

        .keyfield {
            background-color: white; /* Key field background color */
        }

        form {
            width: 500px;
            margin: 20px auto;
            background-color: white; /* Set form background color to white */
        }

        /* Edit form styling */
        .editForm {
            display: none;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            width: 500px;
        }

        .editForm h2 {
            margin-bottom: 20px;
        }

        .editForm input[type="text"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .editForm button[type="submit"] {
            background-color: skyblue; /* Change background color to sky blue */
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 1.5s;
        }

        /* Hover effect for the "Save" button */
        .editForm button[type="submit"]:hover {
            background-color: #87ceeb; /* Green hover color */
        }

        .container {
            max-width: 1000px; /* Adjusted width */
            margin: 50px auto;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: green; /* Color for success message */
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
    <h2>Course Records</h2>

    <table>
        <!-- Table headers -->
        <thead>
            <tr>
                <th class="keyfield">#</th>
                <th>Department</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record) { ?>
                <tr>
                    <!-- Table data -->
                    <td class="keyfield"><?php echo isset($record['Course_Id']) ? $record['Course_Id'] : ''; ?></td>
                    <td><?php echo isset($record['department']) ? $record['department'] : ''; ?></td>
                    <td><?php echo isset($record['course_code']) ? $record['course_code'] : ''; ?></td>
                    <td><?php echo isset($record['course_name']) ? $record['course_name'] : ''; ?></td>
                    <td>
                        <!-- Edit link with onclick event to toggle edit form visibility -->
                        <a href="#" onclick="toggleEditForm(<?php echo isset($record['Course_Id']) ? $record['Course_Id'] : ''; ?>)">Edit</a>
                    </td>
                    <td>
                        <!-- Delete link -->
                        <a href="delete.php?id=<?php echo isset($record['Course_Id']) ? $record['Course_Id'] : ''; ?>">Delete</a>
                    </td>
                </tr>
                <!-- Hidden edit form row -->
                <tr id="editFormRow_<?php echo isset($record['Course_Id']) ? $record['Course_Id'] : ''; ?>" class="editForm">
                    <td colspan="6">
                        <form action="update.php" method="post">
                            <input type="hidden" name="id" value="<?php echo isset($record['Course_Id']) ? $record['Course_Id'] : ''; ?>">
                            <input type="text" name="department" value="<?php echo isset($record['department']) ? $record['department'] : ''; ?>">
                            <input type="text" name="courseCode" value="<?php echo isset($record['course_code']) ? $record['course_code'] : ''; ?>">
                            <input type="text" name="courseName" value="<?php echo isset($record['course_name']) ? $record['course_name'] : ''; ?>">
                            <button type="submit">Save</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- JavaScript for edit functionality -->
<script>
    function editRecord(id, department, courseCode, courseName) {
        // Populate the form fields with the record data
        document.getElementById('editId').value = id;
        document.getElementById('editDepartment').value = department;
        document.getElementById('editCourseCode').value = courseCode;
        document.getElementById('editCourseName').value = courseName;
        // Show the edit form
        document.getElementById('editForm').style.display = 'block';
    }

    // Function to toggle edit form visibility
    function toggleEditForm(id) {
        var editFormRow = document.getElementById('editFormRow_' + id);
        if (editFormRow.style.display === 'none') {
            editFormRow.style.display = 'table-row';
        } else {
            editFormRow.style.display = 'none';
        }
    }
</script>
</body>
</html>
