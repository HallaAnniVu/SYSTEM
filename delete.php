<?php
session_start();
include_once 'connection.php';

$notification = '';

if (isset($_GET['id'])) {
    // Prepare and bind the parameter to prevent SQL injection
    $id = intval($_GET['id']);
    
    // Prepare the SQL statement
    $sql = "DELETE FROM courses WHERE Course_Id = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Set notification for successful deletion
        $notification = "Course record deleted successfully!";
    } else {
        // Set notification for deletion error
        $notification = "Error deleting record: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Redirect back to showrecords.php with notification
header("Location: showrecords.php?notification=" . urlencode($notification));
exit();
?>
