<?php
// Include your database connection file
include 'connection.php';

// Check if the Enrolment_Id is set in the query parameters
if (isset($_GET['id'])) {
    $enrolmentId = $_GET['id'];

    // Prepare the SQL select statement
    $sql = "SELECT * FROM students WHERE id = ?";

    // Initialize a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the Enrolment_Id parameter
    $stmt->bind_param('i', $enrolmentId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Set headers to prompt the user for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="enrollmentform' . $enrolmentId . '.csv"');

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Output the column headings
        fputcsv($output, array('Enrollment number', 'Student id', 'Last Name', 'First Name', 'Middle Name', 'Gender', 'Address', 'Course', 'Year'));

        // Output the data
        fputcsv($output, $row);

        // Close the output stream
        fclose($output);
    } else {
        echo "No record found with id: " . $enrolmentId;
    }
    
    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
