<?php
include_once 'connection.php';

if(isset($_POST['id'], $_POST['department'], $_POST['courseCode'], $_POST['courseName'])) {
    // Prepare and bind the parameters to prevent SQL injection
    $id = $_POST['id'];
    $department = $_POST['department'];
    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    
    // Prepare the SQL statement
    $sql = "UPDATE courses SET department=?, course_code=?, course_name=? WHERE Course_Id=?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("sssi", $department, $courseCode, $courseName, $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        $notification = "Record updated successfully";
    } else {
        $notification = "Error updating record: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $conn->close();
    
    // Redirect back to the showrecords.php
    header("Location: showrecords.php");
    exit();
} else {
    // Handle invalid request
    $notification = "Invalid request";
}
?>
