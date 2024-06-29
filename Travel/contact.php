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
    <section style="font-family: Poppins,sans-serif;" \>
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Contact Us</h2>
            <form action="#" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                    <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required>
                </div>
                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                    <input type="text" id="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Let us know how we can help you" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
                    <textarea id="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."></textarea>
                </div>
                <button type="submit" class="py-3 px-5 text-sm bg-black font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send message</button>
            </form>
        </div>
    </section>
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