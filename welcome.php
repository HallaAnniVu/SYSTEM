<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            background-image: url('background.jpg'); /* Background image */
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center; 
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .form-container {
            background-color: #fff; /* White background color */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow */
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        input[type="submit"] {
            width: 200px;
            border-radius: 4px;
            border: none;
            padding: 10px;
            cursor: pointer;
            background-color: #87CEEB; /* Sky blue button color */
            color: #000000; /* White text color */
            margin-top: 20px;
            transition: background-color 0.3s; /* Smooth transition */
        }

        input[type="submit"]:hover {
            background-color: #5F9EA0; /* Darker sky blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Good day, <?php echo $_SESSION['username']; ?>!</h1>
            <form method="POST" action="course.php">
                <input type="submit" value="Add Course">
            </form>
        </div>
    </div>
</body>
</html>
