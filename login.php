<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: welcome.php");
    exit();
}

$login = false;
include('connection.php');
if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $sql = "SELECT * FROM db1 WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        if (password_verify($password, $row["password"])) {
            $login = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['loggedin'] = true;
            header("Location: welcome.php");
            exit();
        }
    } else {
        echo  '<script>
            alert("Login failed. Invalid username or password!!");
            window.location.href = "login.php";
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
    <title>Login here</title>
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

        input[type="text"], input[type="password"], input[type="submit"] {
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
            margin-top: 10px; /* Add margin to the top */
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
    </style>


</head>
<body>
    <div id="form">
        <form name="form" action="login.php" method="POST" onsubmit="return isValid()">
            <h1 id="heading">Login here</h1>
            <label>Enter Username/Email: </label>
            <input type="text" id="user" name="user" required><br><br>
            <label>Password:</label>
            <input type="password" id="pass" name="pass" class="form-control" required>
            <br>
            <input type="submit" id="btn" value="Login" name="submit"/>
            <div class="links">
                Don't have an account? <a href="signup.php">Sign Up Now</a>
            </div>
        </form>
    </div>
    <script>
        function isValid() {
            var user = document.forms["form"]["user"].value;
            if (user == "") {
                alert("Enter username or email id!");
                return false;
            }
        }
    </script>
</body>
</html>
