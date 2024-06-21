<?php
session_start();
if (isset($_SESSION["signup_info"])) {
    header("Location: showrecords.php");
    exit();
}

include_once 'connection.php';

$message = ''; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course_name = isset($_POST['course_name']) ? mysqli_real_escape_string($conn, $_POST['course_name']) : ''; // Assign empty string if not set
    $department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : ''; // Assign empty string if not set
    
    // Insert course into the database
    $sql = "INSERT INTO courses (department, course_name, course_code) VALUES ('$department', '$course_name', '$course_code')";
    if (mysqli_query($conn, $sql)) {
        $message = "Course added successfully!";
    } else {
        $message = "Error: Could not add course.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management Form</title>
    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center; 
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
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
            color: #000000; /* White text color */
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
            min-height: 100vh;
            flex-direction: column;
            margin-top: 80px; /* Updated margin to push form below the navbar */
        }

        h1 {
            color: black;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px; /* Adjust the font size as needed */
        }

        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
        }

        form {
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        select,
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            border-radius: 4px;
            border: 3px solid #9CD3DC;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: calc(100% - 6px);
            border-radius: 4px;
            border: 3px solid #9CD3DC;
            padding: 10px;
            cursor: pointer;
            background-color: #9CD3DC;
            color: #000000;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
        <h1>Course Management Form</h1>

        <?php
        if (!empty($message)) {
            echo "<p class='success-message'>$message</p>";
        }
        ?>

        <form method="POST" action="">
            <label for="department">Department:</label><br>
            <select id="department" name="department" onchange="populateCourseOptions()" required>
                <option value="">Select Department</option>
                <option value="CED">CED</</option>
                <option value="CCSS">CCSS</option>
                <option value="CS">CS</option>
                <option value="CCJE">CCJE</option>
                <option value="CCSICT">CCSICT</option>
                <option value="CoE">CoE</option>
                <option value="IBM">IBM</option>
                <option value="CFEM">CFEM</option>
                <option value="CAST">CAST</option>
            </select><br>

            <label for="course_name">Course Name:</label><br>
            <select id="course_name" name="course_name" required>
                <!-- Course options will be populated dynamically based on the selected department -->
            </select><br>

            <label for="course_code">Course Code:</label><br>
            <input type="text" id="course_code" name="course_code" placeholder="ex.BSIT" required><br>
            
            <input type="submit" name="submit" value="Add Course">
        </form>
    </div>

    <script>
        // Define course options based on department
        const courseOptions = {
            "CED": [
                "Bachelor of Secondary Education",
                "Bachelor of Elementary Education",
                "Bachelor of Physical Education",
                "Bachelor of Early Childhood Education",
                "Bachelor of Technology and Livelihood Education"
            ],
            "CCSS": [
                "Bachelor of Science in Development Communication",
                "Bachelor of Arts in Communication",
                "Bachelor of Arts in Sociology"
            ],
            "CS": [
                "Bachelor of Science in Biology",
                "Bachelor of Science in Physics",
                "Bachelor of Science in Mathematics",
                "Bachelor of Science in Psychology"
            ],
            "CCJE": [
                "Bachelor of Science in Criminology",
                "Bachelor of Science in Law Enforcement Administration",
                "Bachelor of Science in Industrial Security Management"
            ],
            "CCSICT": [
                "Bachelor of Science in Information Technology",
                "Bachelor of Science in Computer Science"
            ],
            "CoE": [
                "Bachelor of Science in Computer Engineering",
                "Bachelor of Science in Electronics Engineering"
            ],
            "IBM": [
                "Bachelor of Science in Hospitality Management",
                "Bachelor of Science in Tourism Management",
                "Bachelor of Science in Agri-Business",
                "Bachelor of Science in Entrepreneurship"
            ],
            "CFEM": [
                "Bachelor of Science in Forestry",
                "Bachelor of Science in Environmental Science"
            ],
            "CAST": [
                "Bachelor of Science in Agriculture",
                "Diploma in Agricultural Science",
                "Diploma in Agricultural Technology"
            ]
        };

        // Function to populate course options based on selected department
        function populateCourseOptions() {
            const department = document.getElementById("department").value;
            const courseSelect = document.getElementById("course_name");
            courseSelect.innerHTML = ""; // Clear previous options

            if (department in courseOptions) {
                courseOptions[department].forEach(course => {
                    const option = document.createElement("option");
                    option.value = course;
                    option.text = course;
                    courseSelect.appendChild(option);
                });
            }
        }

        // Initialize course options on page load if department is already selected
        window.onload = function() {
            populateCourseOptions();
        };
    </script>
</body>
</html>
