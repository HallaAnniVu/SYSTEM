<?php
// Include your database connection file
include 'connection.php';

// Check if the search term is provided in the URL
if(isset($_GET['search'])) {
    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    
    // Construct the SQL query to search for records
    $sql = "SELECT * FROM students WHERE 
            student_no LIKE '%$searchTerm%' OR 
            lastname LIKE '%$searchTerm%' OR 
            firstname LIKE '%$searchTerm%' OR 
            middlename LIKE '%$searchTerm%' OR 
            gender LIKE '%$searchTerm%' OR 
            address LIKE '%$searchTerm%' OR 
            course LIKE '%$searchTerm%' OR 
            year LIKE '%$searchTerm%'";
    
    // Execute the query
    $result = $conn->query($sql);

    // Check if there are any matching records
    if ($result->num_rows > 0) {
        // Output data of each matching row
        while ($row = $result->fetch_assoc()) {
            echo "<p>Student No: " . $row["student_no"] . "</p>";
            echo "<p>Last Name: " . $row["lastname"] . "</p>";
            echo "<p>First Name: " . $row["firstname"] . "</p>";
            echo "<p>Middle Name: " . $row["middlename"] . "</p>";
            echo "<p>Gender: " . $row["gender"] . "</p>";
            echo "<p>Address: " . $row["address"] . "</p>";
            echo "<p>Course: " . $row["course"] . "</p>";
            echo "<p>Year: " . $row["year"] . "</p>";
        }
    } else {
        echo "No matching records found.";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect back to the search page if no search term is provided
    header("Location: reports.php");
    exit();
}
?>
