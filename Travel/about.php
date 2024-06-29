<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
        }

        .Login {
            height: 100vh;
        }

        .login {
            width: 40%;
            margin-left: 30%;
            margin-right: 30%;
            box-shadow: 3px 3px 5px gray;
            border-radius: 10px;
            height: 60%;
            margin-top: 5%;
            margin-bottom: 5%;
            background-color: white;
            opacity: 0.5;
            padding: 2%;
        }

        label {
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            font-size: 1.5em;
            letter-spacing: 0.2em;
            margin-bottom: 10%;
        }

        input {
            width: 45%;
            padding: 2%;
            border-radius: 5px;
            background-color: white;
            font-size: 1em;
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            color: black;
        }

        form {
            margin-top: 10%;
            width: 100%;
        }

        .input1 {
            width: 100%;
            margin: 5%;
            margin-left: 25%;
        }

        #loginButton {
            border-radius: 10px;
            border: none;
            width: 50%;
            margin-left: 25%;
            background-color: #085a57;
            color: white;
            padding: 2%;
            font-size: 1.5em;
            letter-spacing: 0.1em;
        }

        h1 {
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            font-size: 2.5em;
            color: black;
            letter-spacing: 0.1em;
            text-align: center;
            width: 100%;
            margin-top: 2%;
        }

        h4 {
            width: 50%;
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            font-size: 1.5em;
            color: black;
            letter-spacing: 0.1em;
            text-align: center;
            margin-top: 2%;
        }

        a {
            text-decoration: underline 1px black;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="summer.php">Summer</a></li>
            <li><a href="winter.php">Winter</a></li>
            <li><a href="spring.php">Spring</a></li>
            <li><a href="fall.php">Fall</a></li>
            <?php if (isset($_SESSION['user_email']) && isset($_SESSION['user_id'])) : ?>
                <li style="color:white; font-family:Poppins; font-weight:100; width:20%">
                    <?php if ($_SESSION['user_type'] === 'admin') { ?>
                        <a href="admin.php"><?php echo $_SESSION['user_email']; ?></a>
                    <?php } else { ?>
                        <?php echo $_SESSION['user_email']; ?>
                    <?php } ?>
                </li>
                <?php if ($_SESSION['user_type'] === 'user') { ?>
                    <li><a href="myBookings.php?userID=<?php echo $_SESSION['user_id']; ?>">My Bookings</a></li>
                <?php } ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else : ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div style="font-family: Poppins,sans-serif;" class="xl:container 2xl:mx-auto lg:py-16 lg:px-20  ">
        <div class="flex flex-col lg:flex-row justify-between gap-5 ">
            <div class="w-full lg:w-5/12 flex flex-col justify-center">
                <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800 dark:text-white pb-4">About Us</h1>
                <p class="font-normal text-base leading-6 text-gray-600 dark:text-white">Welcome! We are a passionate team of travel enthusiasts dedicated to creating unforgettable travel experiences for our clients. With years of expertise, we specialize in crafting personalized itineraries that cater to your unique interests and desires. Whether you're seeking adventure, relaxation, or cultural immersion, we are here to make your dream vacation a reality. Let us guide you on your next journey and help you discover the world in a whole new way.</p>
            </div>
            <div class="lg:w-1/2 jusrify-between flex flex-col items-center pt-8">
                <img src="landscape1.jpg" alt="A group of People" />
            </div>
        </div>

        <div class="items-center flex-col justify-between gap-8 pt-0">
            <div class="w-full lg:w-5/12 flex flex-col justify-center items-center">
                <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800 dark:text-white pb-4">Our Story</h1>
                <p class="font-normal text-base leading-6 text-gray-600 dark:text-white">Our journey began with a simple love for travel and exploration. Each member of our team brings their own travel expertise and enthusiasm, ensuring that every journey we plan is infused with a genuine passion for discovery. From humble beginnings to a thriving travel service, our story is all about turning dreams into unforgettable adventures.</p>
            </div>

        </div>
    </div>

    <footer class="body-container">
        <div class="footer-element">
            <img src="logo.jpg" height="120" width="120" style="border-radius: 20px;">
        </div>
        <div class="footer-element">
            <h2>Links</h2>
            <ul>
                <li><a href="home.php"><i class="fa-solid fa-angles-right"></i> Home</a></li>
                <li><a href="about.php"><i class="fa-solid fa-angles-right"></i> About Us</a>
                <li><a href="contact.php"><i class="fa-solid fa-angles-right"></i> Contact</a>

            </ul>
        </div>
        <div class="footer-element">
            <h2>Follow Us</h2>
            <ul>
                <li><a href="https://www.facebook.com"><i class="fa-brands fa-facebook-f"></i> Facebook</a></li>
                <li><a href="https://www.instagram.com"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
                <li><a href="https://www.linkedin.com"><i class="fa-brands fa-linkedin-in"></i> Linkedin</a></li>
            </ul>
        </div>
        <div class="footer-element">
            <h2>Address</h2>
            <ul>
                <li class="address1"><i class="fa-solid fa-location-dot"></i> Adresa Skopje 1000</li>
                <li><i class="fa-solid fa-phone"></i> +91 90904500112</li>
                <li><i class="fa-solid fa-envelope"></i> mail@1234567.com</li>
            </ul>
        </div>
    </footer>
</body>

</html>