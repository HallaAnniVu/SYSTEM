<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['pass']; // Remove mysqli_real_escape_string for password
        $cpassword = $_POST['cpass']; // Remove mysqli_real_escape_string for confirm password
        
        // Password complexity check
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
        if (!preg_match($passwordPattern, $password)) {
            echo '<script>
                alert("Your password must be 8 characters and a combination of numbers and letters!");
                window.location.href = "signup.php";
            </script>';
            exit();
        }

        // Password case sensitivity check
        if ($password !== $cpassword) {
            echo '<script>
                alert("Passwords do not match");
                window.location.href = "signup.php";
            </script>';
            exit();
        }

        // Validate Gmail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
            echo '<script>
                alert("Enter valid email");
                window.location.href = "signup.php";
            </script>';
            exit();
        }

        // Check if username or email already exists
        $sql_user = "SELECT * FROM db1 WHERE username='$username'";
        $sql_email = "SELECT * FROM db1 WHERE email='$email'";
        $result_user = mysqli_query($conn, $sql_user);
        $result_email = mysqli_query($conn, $sql_email);
        $count_user = mysqli_num_rows($result_user);
        $count_email = mysqli_num_rows($result_email);

        if($count_user > 0) {
            echo '<script>
                alert("Username already exists!!");
                window.location.href="signup.php";
            </script>';
            exit();
        }

        if($count_email > 0) {
            echo '<script>
                alert("Email already exists!!");
                window.location.href="signup.php";
            </script>';
            exit();
        }

        // Hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new user
        $sql_insert = "INSERT INTO db1 (username, email, password) VALUES ('$username', '$email', '$hash')";
        $result_insert = mysqli_query($conn, $sql_insert);

        if($result_insert){
            // Confirmation message
            echo '<script>
                alert("Registration successful! Please log in.");
                window.location.href = "login.php"; // Redirect to login page after signup
            </script>';
        } else {
            echo '<script>
                alert("Error in registration. Please try again later.");
                window.location.href = "signup.php";
            </script>';
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center; 
            font-family: Arial, sans-serif;
            color: #333; /* Text color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            flex-direction: column;
        }

        h1, h3 {
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

        input[type="text"], input[type="password"], input[type="submit"], input[type="email"] {
            width: 100%; /* Set width to 100% */
            border-radius: 4px;
            border: 3px solid #9CD3DC;
            padding: 10px; /* Increased padding */
            box-sizing: border-box; /* Include padding in width calculation */
        }

        input[type="submit"] {
            cursor: pointer;
            background-color: #87CEEB; /* Sky blue background color */
            color: #000000; /* Button text color */
            margin-top: 20px; /* Add margin to the top */
            margin-bottom: 20px; /* Add margin to the bottom */
        }

        .links {
            margin-top: 10px; /* Add margin to the top */
            text-align: center; /* Center-align the text */
        }

        a {
            color: #000000; /* Link color */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Confirmation message style */
        #confirmation {
            color: green; /* Green color for success */
            text-align: center;
            margin-bottom: 10px; /* Add margin below the confirmation message */
        }
    </style>
</head>

<body>
    <div id="form">
        <form name="form" action="signup.php" method="POST">
            <!-- Confirmation message -->
            <div id="confirmation"><?php if(isset($confirmationMessage)) echo $confirmationMessage; ?></div>
            <h1 id="heading">Signup here</h1><br>
            <label>Enter Username: </label>
            <!-- Input field for username -->
            <input type="text" id="user" name="user" placeholder="ex.Juan Dela Cruz" required><br><br>
            <label>Enter Email </label>
            <!-- Input field for email -->
            <input type="email" id="email" name="email" placeholder="example@gmail.com" required><br><br>
            <label>Create Password  </label>
            <!-- Input field for password -->
            <input type="password" id="pass" name="pass" placeholder="Minimum 8 characters" required><br><br>
            <label>Retype Password: </label>
            <!-- Input field for confirming password -->
            <input type="password" id="cpass" name="cpass" required><br><br>
            <br><br>
            <!-- Button for submitting form -->
            <input type="submit" id="btn" value="SignUp" name="submit"/>
            <div class="links">
                <a href="login.php">Already have an account? Log In</a>
            </div>
        </form>
    </div>

    <script>
        // Function to display confirmation message
        function displayConfirmation(message) {
            const confirmationDiv = document.getElementById("confirmation");
            confirmationDiv.innerHTML = message;
        }
    </script>
</body>
</html>
