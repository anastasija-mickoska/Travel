<?php
session_start();

include "db_connect.php";
include "arrangement_functions.php";
$featured = get_featured_destinations($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">


    <style>
        body {
            margin: 0;
            padding: 0;
        }

        section {
            display: block;
        }

        #homepage {
            height: 100vh;
            background:
                linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                url('landscape.jpg') no-repeat center center/cover;
            margin: 0;
        }

        #homepage_statement {
            width: 100%;
            height: 300px;
            margin-top: 10%;
            color: white;
        }

        #home {
            text-align: center;
            position: relative;
            width: 100%;
            font-size: 4em;
            letter-spacing: 0.25em;
            font-family: 'Poppins', 'sans-serif';
            font-weight: 500;
        }

        #home2 {
            text-align: center;
            position: relative;
            width: 100%;
            font-size: 2em;
            letter-spacing: 0.2em;
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            padding-top: 2%;
        }

        #search {
            width: 70%;
            height: 150px;
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 2%;
        }

        .search1 {
            float: left;
            width: 25%;
            margin-left: 2%;
        }

        label {
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            font-size: 1.5em;
            letter-spacing: 0.1em;
            color: white;
        }

        input,
        select {
            padding: 5%;
            border-radius: 5px;
            border: none;
            width: 70%;
            opacity: 0.3;
            font-family: 'Poppins', 'sans-serif';
            font-size: 1em;
        }

        option {
            font-family: 'Poppins', 'sans-serif';
            font-size: 1em;
        }

        #searchButton {
            width: 15%;
            border-radius: 5px;
            border: none;
            margin-top: 2.5%;
            padding: 1.4%;
            background-color: #085a57;
            opacity: 1;
            color: white;
        }

        #destination1 {
            font-family: 'Poppins', 'sans-serif';
            font-size: 1.75em;
            font-weight: 300;
            width: 80%;
            margin-left: 10%;
            text-align: center;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        h1 {
            font-family: 'Poppins', 'sans-serif';
            font-size: 4em;
            font-weight: 500;
            text-align: center;
            letter-spacing: 0.2em;
            text-decoration: underline 2px black;
            text-underline-offset: 5px;
            margin: 2%;
        }

        a {
            text-decoration: none;
        }

        #featured {
            height: 70vh;
        }

        .featuredItems {
            width: 25%;
            height: 50vh;
            float: left;
            margin-left: 4%;
            margin-right: 4%;
        }

        .featured1 {
            width: 100%;
            border-radius: 5px;
            background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('summer2.avif');
            background-size: cover;
            height: 100%;
            margin: 1.5%;
            position: relative;
            box-sizing: border-box;
        }

        .desc {
            width: 100%;
            height: 10vh;
        }
    </style>
</head>

<body>
    <section id="homepage">
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
        <form method="get" id="searchForm" action="showDestinationsBySearch.php">
            <div id="search">
                <div class="search1">
                    <label for="destination">DESTINATION</label> <br>
                    <input type="text" name="destination">
                </div>
                <div class="search1">
                    <label for="when">WHEN</label> <br>
                    <select name="when">
                        <option value=" "></option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="search1">
                    <label for="duration">HOW LONG</label> <br>
                    <select name="duration">
                        <option value=" "></option>
                        <option value="1-3">1-3 days</option>
                        <option value="3-5">3-5 days</option>
                        <option value="week">One week</option>
                        <option value="1-2weeks">1-2 weeks</option>
                        <option value="2+">More than two weeks</option>
                    </select>
                </div>
                <input type="submit" value="SEARCH" id="searchButton">
            </div>
        </form>
        <div id="homepage_statement">
            <p id="home"> LET'S TRAVEL THE WORLD!
            </p>
            <p id="home2">
                Travel. Explore. Experience.
            </p>
        </div>
    </section>
    <section id="featured">
        <h1>FEATURED</h1>
        <?php foreach ($featured as $destination) { ?>
            <div class="featuredItems">
                <a href="details.php?name=<?php echo $destination['destinationName']; ?>">
                    <div class="featured1" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(' <?php echo $destination['imgUrl']; ?>') no-repeat center center/cover; ">
                        <div class="desc">
                            <h3 id="destination1"><?php echo $destination['destinationName']; ?></h3>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </section>
    <footer class="body-container">
        <div class="footer-element image">
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
