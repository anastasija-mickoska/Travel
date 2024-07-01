<?php
session_start();
require_once("../Functions/https_secure_connection.php");
include "../config/db_connect.php";
include "../Models/arrangement_functions.php";
$destination = search_destinations_homepage($conn);
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
<style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background:
                linear-gradient(rgba(8, 90, 87, 0.8), rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
        }

        h2 {
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            font-size: 2.5em;
            color: white;
            letter-spacing: 0.25em;
            width: 80%;
            margin-left: 5%;
            margin-top: 2%;
            text-decoration: underline 1px white;
            text-underline-offset: 5px;
        }

        h3 {
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            font-size: 1.75em;
            color: white;
            letter-spacing: 0.1em;
            width: 80%;
            margin-left: 5%;
            margin-top: 2%;
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
    <h2>Search results</h2>
    <section class="arr">
        <?php
        if (empty($destination)) { ?>
            <h3> <?php echo "No results were found based on this search.";  ?> </h3> <?php
            } else {
            foreach ($destination as $dest) { ?>
                <a href="details.php?id=<?php echo $dest['destinationID']; ?>&name=<?php echo urlencode($dest['destinationName']); ?>">
                    <div class="arr1" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $dest['imgUrl']; ?>') no-repeat center center/cover;">
                        <div class="desc">
                            <h3><?php echo $dest['destinationName']; ?></h3>
                            <h4><i><?php echo $dest['fromDate']; ?> - <?php echo $dest['toDate']; ?> </i></h4>
                            <h4 class="price"><?php echo $dest['price']; ?></h4>
                        </div>
                    </div>
                </a>
        <?php }
        } ?>
    </section>
    <footer class="body-container">
        <div class="footer-element">
            <img src="../Images/logo.jpg" height="120" width="120" style="border-radius: 20px;">
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