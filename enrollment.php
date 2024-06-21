<!DOCTYPE html>
<html>
<head>
    <title>Student Enrollment Form</title>
    <style>
        body {
            background-image: url('background.png');
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center; 
            font-family: Arial, sans-serif;
            color: #333; /* Text color */
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

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 180vh;
            flex-direction: column;
            margin-top: 80px; /* Add space below the navbar */
        }

        h2 {
            color: #000000; /* Header text color */
            text-align: center; /* Center-align the text */
            margin-bottom: 20px; /* Add some space below the heading */
        }

        form {
            background-color: #fff; /* Form background color */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%; /* Set width to 100% */
            border-radius: 4px;
            border: 3px solid #9CD3DC;
            padding: 5px;
        }

        input[type="submit"] {
            width: calc(100% - 6px); /* Set width to 100% minus the border width */
            border-radius: 4px;
            border: 3px solid #9CD3DC;
            padding: 10px; /* Increased padding to match input fields */
            cursor: pointer;
            background-color: #9CD3DC; /* Button background color */
            color: #000000; /* Button text color */
            margin-top: 10px; /* Add margin to the top */
        }

        .input-group {
            display: flex; /* Use flexbox */
            align-items: center; /* Vertically center content */
            justify-content: space-between; /* Spacing between items */
        }

        .input-group-text {
            margin-top: 5px; /* Add some space between password and checkbox */
        }

        .show-password {
            display: none; /* Hide the show password checkbox */
        }

        .links {
            margin-top: 10px; /* Add margin to the top */
        }

        a {
            color: #000000; /* Link color */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .address-button {
            display: block;
            width: 100%;
            border-radius: 4px;
            border: 3px solid #9CD3DC;
            padding: 10px;
            background-color: #9CD3DC;
            color: #000000;
            margin-top: 10px;
            cursor: pointer;
        }

        .address-button:hover {
            background-color: #45a049;
        }

        select {
            width: 100%;
            border-radius: 4px;
            border: 3px solid #9CD3DC;
            padding: 5px;
        }

        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
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
        <h2>Student Enrollment Form</h2>

        <?php
        $message = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include database connection file
            include_once 'connection.php';

            // Check if form fields are set in $_POST
            if (!empty($_POST['student_no']) && !empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['gender']) && !empty($_POST['address']) && !empty($_POST['course']) && !empty($_POST['year']) && !empty($_POST['subjects'])) {
                // Prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO students (student_no, lastname, firstname, middlename, gender, address, course, year, subjects) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssss", $student_no, $lastname, $firstname, $middlename, $gender, $address, $course, $year, $subjects);

                // Set parameters
                $student_no = $_POST['student_no'];
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : null; // Check if middlename is set
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $course = $_POST['course'];
                $year = $_POST['year'];
                $subjects = implode(", ", $_POST['subjects']); // Convert subjects array to a string

                // Execute statement
                if ($stmt->execute()) {
                    $message = "Enrolled successfully!";
                } else {
                    $message = "Error: Could not enroll.";
                }

                $stmt->close();
            }

            // Close connection
            $conn->close();
        }
        ?>

        <?php
        if (!empty($message)) {
            echo "<p class='success-message'>$message</p>";
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="student_no">Student id number:</label>
            <input type="text" id="student_no" name="student_no" placeholder="ex.23-01234 or 20123456789" required><br> 

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required><br>

            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required><br>

            <label for="middlename">Middle Name:</label>
            <input type="text" id="middlename" name="middlename"><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br>

            <!-- Change address field into a button -->
            <label for="address">Address:</label>
            <input type="text" class="address" id="address" name="address" placeholder="Enter Address" required><br>

            <label for="course">Course:</label>
            <input type="text" id="course" name="course" placeholder="ex.Bachelor of Science in Information Technology" required><br>

            <!-- Change year field into a dropdown -->
            <label for="year">Year:</label>
            <select id="year" name="year" required>
                <option value="1st">1st Year</option>
                <option value="2nd">2nd Year</option>
                <option value="3rd">3rd Year</option>
                <option value="4th">4th Year</option>
            </select><br>

            <!-- Add subjects checkboxes -->
            <label for="subjects">Subjects:</label>
            <div>
                <input type="checkbox" id="networking_1" name="subjects[]" value="Networking 1">
                <label for="networking1">Networking_1</label><br>
                <input type="checkbox" id="appdev1" name="subjects[]" value="Appdev 1">
                <label for="appdev1">Appdev 1</label><br>
                <input type="checkbox" id="quantitative_methods" name="subjects[]" value="Quantitative Methods">
                <label for="quantitative_methods">Quantitative Methods</label><br>
                <input type="checkbox" id="pe" name="subjects[]" value="PE">
                <label for="pe">PE</label><br>
                <input type="checkbox" id="life_and_works_of_rizal" name="subjects[]" value="The Life and Works of Rizal">
                <label for="life_and_works_of_rizal">The Life and Works of Rizal</label><br>
                <input type="checkbox" id="the_entreprenurial_mind" name="subjects[]" value="The Life and Works of Rizal">
                <label for="The Entrepreneurial Mind">The Life and Works of Rizal</label><br>
                <input type="checkbox" id="accounting" name="subjects[]" value="The Life and Works of Rizal">
                <label for="life_and_works_of_rizal">Accounting</label><br>
                <input type="checkbox" id="information_management" name="subjects[]" value="The Life and Works of Rizal">
                <label for="life_and_works_of_rizal">Information Management</label><br>
            </div>
            
            <input type="submit" value="Submit">
        </form>
    </div>

    <script>
        // JavaScript function to handle changing address
        function promptAddress() {
            var newAddress = prompt("Please enter your address:", "");
            if (newAddress != null) {
                document.getElementById("address").value = newAddress;
            }
        }
    </script>
</body>
</html>
