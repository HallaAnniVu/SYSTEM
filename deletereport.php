<?php
// Include your database connection file
include 'connection.php';

if(isset($_GET['id'])) {
    $delete_id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id='$delete_id'";
    if(mysqli_query($conn, $sql)) {
        $confirmation_message = "Information deleted successfully!";
        echo "<script>alert('$confirmation_message'); window.location.href='report.php';</script>";
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}


// Close connection
$conn->close();
?>
