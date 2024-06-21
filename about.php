<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-image: url('background.png');
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center; 
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        /* CSS styles for the navbar */
        .navbar {
            background-color: #87CEEB;
            width: 100%;
            padding: 20px 0;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
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
            color: #000000;
            font-weight: bold;
            font-size: 1.2em;
            padding: 15px 20px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Profile content styles */
        .profile-content {
            text-align: center;
            margin: 100px auto 20px; /* Adjusted margin-top for fixed navbar */
            max-width: 1200px; /* Center the content */
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .profile-content h2 {
            color: black;
            font-weight: bold;
            width: 100%; /* Full width for the heading */
            margin-bottom: 40px;
        }

        .profile {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            width: 30%; /* Three columns */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile img {
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .profile h3 {
            color: #333;
            font-weight: bold;
        }

        .profile p {
            color: #555;
            margin: 5px 0;
        }

        .quote {
            font-style: italic;
            margin: 10px 0;
        }

        .contact {
            margin-top: 15px;
        }

        .contact p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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

    <!-- Main content -->
    <div class="container">
        <div class="profile-content">
            <h2>About Us</h2>

            <div class="profile">
                <h3>Donalyn Malsi</h3>
                <img src="donalyn.jpg" alt="Donalyn Malsi" width="200" height="200">
                <p> Name: Donalyn Malsi<br>
                    Address: Ammugauan Sto. Tomas Isabela<br>
                    School: Isabela State University Cabagan-Campus<br>
                    Course: Bachelor of Science in Information Technology</p>
                <p>Favorite Quote</p>
                <p class="quote">-Isaiah 60:22-</p>
                <p class="quote">“When the time is right, I the Lord make it happen”.</p>
                <div class="contact">
                    <p><i class="fas fa-envelope"></i> Gmail: donalynmalsi@gmail.com</p>
                    <p><i class="fab fa-facebook"></i> Facebook: Donalyn Malsi</p>
                </div>
            </div>

            <div class="profile">
                <h3>Elmarie Cataggatan</h3>
                <img src="elmarie.jpg" alt="Elmarie Cataggatan" width="200" height="200">
                <p> Name: Elmarie Cataggatan<br>
                    Address: Cabagan Isabela<br>
                    School: Isabela State University Cabagan-Campus<br>
                    Course: Bachelor of Science in Information Technology</p>
                <p>Favorite Quote</p>
                <p class="quote">-"You will face many defeats in life, but never let your life be defeated."-</p>
                <div class="contact">
                    <p><i class="fas fa-envelope"></i> Gmail: cataggatanmarie29@gmail.com</p>
                    <p><i class="fab fa-facebook"></i> Facebook: Elmarie Cataggatan</p>
                </div>
            </div>

            <div class="profile">
                <h3>April Joy Cataggatan</h3>
                <img src="april.jpg" alt="April Joy Cataggatan" width="200" height="200">
                <p> Name: April Cataggatan<br>
                    Address: Cabagan Isabela<br>
                    School: Isabela State University Cabagan-Campus<br>
                    Course: Bachelor of Science in Information Technology</p>
                <p>Favorite Quote</p>
                <p class="quote">-"To dream is free,But to make it happen is a choice."-</p>
                <div class="contact">
                    <p><i class="fas fa-envelope"></i> Gmail: apriljoycataggatan@gmail.com</p>
                    <p><i class="fab fa-facebook"></i> Facebook: Apriljoy Cataggatan</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
