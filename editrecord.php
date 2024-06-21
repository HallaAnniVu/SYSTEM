<?php
session_start();
if (isset($_SESSION["signup_info"])) {
    header("Location: course.php");
    exit();
}

include_once 'connection.php';

// Function to fetch a single record from the database
function fetchRecord($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM courses WHERE Course_Id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Function to update a record in the database
function updateRecord($conn, $id, $department, $course_code, $course_name) {
    $stmt = $conn->prepare("UPDATE courses SET department=?, course_code=?, course_name=? WHERE Course_Id=?");
    $stmt->bind_param("sssi", $department, $course_code, $course_name, $id);
    return $stmt->execute();
}

// Check if the form is submitted
if (isset($_POST['edit_submit'])) {
    $id = $_POST['edit_id'];
    $department = $_POST['edit_department'];
    $course_code = $_POST['edit_course_code'];
    $course_name = $_POST['edit_course_name'];
    if (updateRecord($conn, $id, $department, $course_code, $course_name)) {
        $confirmation_message = "Information edited successfully!";
        echo "<script>alert('$confirmation_message'); window.location.href='showrecords.php';</script>";
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch the record details for editing
if (isset($_GET['id'])) {
    $record = fetchRecord($conn, $_GET['id']);
    if (!$record) {
        echo "Record not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <style>
        body {
            background-image: url('background.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: black;
            font-weight: bold;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.5s;
        }

        input[type="submit"]:hover {
            background-color: #23DCEF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Record</h2>
        <form method="post" action="">
            <input type="hidden" name="edit_id" value="<?php echo $record['Course_Id']; ?>">
            Department: <input type="text" name="edit_department" value="<?php echo $record['department']; ?>"><br><br>
            Course Code: <input type="text" name="edit_course_code" value="<?php echo $record['course_code']; ?>"><br><br>
            Course Name: <input type="text" name="edit_course_name" value="<?php echo $record['course_name']; ?>"><br><br>
            <input type="submit" name="edit_submit" value="Submit">
        </form>
    </div>
</body>
</html>
