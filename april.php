<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Personal Webpage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-6pLd99bQ+B81QzxrzAtxUMzvU6y0ZQ1yU7bfx5PgaQnB4j0WTLyM4EVRNACq8m0SLSxmE6JvE3NsdGmtFjfFkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            width: 100%;
            box-sizing: border-box;
        }

        nav {
            text-align: left;
            margin-left: 20px;
            width: 80%;
            box-sizing: border-box;
        }

        section {
            padding: 20px;
            margin-bottom: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            width: 80%;
            box-sizing: border-box;
        }

        .profile-info {
            display: flex;
            align-items: flex-start;
        }

        .profile-info img {
            margin-right: 20px;
            border-radius: 50%;
        }

        .text-info {
            flex: 1;
            color: white;
        }

        .text-info p {
            font-weight: bold;
            color: white;
        }

        .quote {
            margin-top: 10px;
        }

        .navigation_bar {
            margin-left: -60%
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to My Personal Webpage</h1>
    </header>
    <nav class="navigation_bar">
        <ul>
            <li><a href="#about">About Me</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
    <section id="about">
        <h2>Hello!</h2>
        <div class="profile-info">
            <img src="april.jpg" alt="My Profile Picture" width="200" height="200">
            <div class="text-info about-text">
                <p> Name: April Cataggatan<br>
                    Address: Cabagan Isabela<br>
                    School: Isabela State University Cabagan-Campus<br>
                    Course: Bachelor of Science in Information Technology</p>
                <p>Favorite Quote</p>
                <p class="quote">-"To dream is free,But to make it happen is a choice."-</p>
                
            </div>
        </div>
    </section>
    <section id="skills">
        <h2>Skills</h2>
        <p><i class="fab fa-html5"></i> HTML</p>
        <p><i class="fab fa-css3-alt"></i> CSS</p>
        <p><i class="fab fa-js"></i> JavaScript</p>
    </section>
    <section id="contact">
        <h2>Contact</h2>
        <p><i class="fas fa-envelope"></i> Gmail: apriljoycataggatan@gmail.com</p>
        <p><i class="fab fa-facebook"></i> Facebook: Apriljoy Cataggatan</p>
    </section>
</body>

</html>
