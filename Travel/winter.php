<?php
session_start();
include "db_connect.php";
include "arrangement_functions.php";
    $id=4;
    $destinations=get_destinations_by_category($conn,$id);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
            }
            h1 {
                font-family: 'Poppins','sans-serif';
                font-weight:300;
                font-size:2.5em;
                color:white;
                letter-spacing: 0.25em;
                width:80%;
                margin-left: 5%;
                margin-top:2%;
                text-decoration: underline 1px white;
                text-underline-offset: 5px;
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
        <?php if (isset($_SESSION['user_email']) && isset($_SESSION['user_id'])): ?>
            <li style="color:white; font-family:Poppins; font-weight:100; width:20%">
                <?php if($_SESSION['user_type'] === 'admin') { ?>
                    <a href="admin.php"><?php echo $_SESSION['user_email']; ?></a>
                <?php } else { ?>
                    <?php echo $_SESSION['user_email']; ?>
                <?php } ?>
            </li>
            <?php if ($_SESSION['user_type'] === 'user') { ?>
                <li><a href="myBookings.php?userID=<?php echo $_SESSION['user_id']; ?>">My Bookings</a></li>
            <?php } ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
            <h1>WINTER</h1>
            <div class="filter">
                <form method="get" action="searchDestinations.php">
                <input type="hidden" name="id" value="4">
                    <div class="Forms">
                        <label class="form1" for="priceRange">Price range</label> <br>
                        <select class="form1" name="priceRange">
                        <option value=""></option>
                        <option value="0-100">0-100</option>
                        <option value="101-200">101-200</option>
                        <option value="201-300">201-300</option>
                        <option value="301-400">301-400</option>
                        <option value="401-500">401-500</option>
                        <option value="500+">500+</option>
                        </select>
                    </div>
                    <div class="Forms">
                        <label class="form1" for="date">Date</label> <br>
                        <input class="form1" type="date" name="date">
                    </div>
                    <div class="Forms">
                        <label class="form1" for="location">Location</label> <br>
                        <input class="form1" type="text" name="location">
                    </div>
                    <div class="Forms">
                        <input class="form1" type="submit" value="SEARCH">
                    </div>
                </form> 
            </div>
            <section class="arr">
                <?php foreach($destinations as $dest) { ?>
                <a href="destination_details.php?id=<?php echo $dest['destinationID']; ?>">
                    <div class="arr1" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $dest['imgUrl'];?>') no-repeat center center/cover;" >
                        <div class="desc">
                            <h3><?php echo $dest['destinationName']; ?></h3>
                            <h4><i><?php echo $dest['fromDate']; ?> - <?php echo $dest['toDate']; ?> </i></h4>
                            <h4 class="price"><?php echo $dest['price']; ?>	&#8364;</h4>
                        </div>
                    </div>
                </a>
                <?php } ?>
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
