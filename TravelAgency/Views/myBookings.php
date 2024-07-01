<?php
session_start();
require_once("../Functions/https_secure_connection.php");
include "../config/db_connect.php";
include "../Models/booking_functions.php";
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
    $id=$_SESSION['user_id'];
    $bookings=get_bookings_by_user($conn,$id);
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../style.css">
        <style>
            body {
                background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
                min-height:100vh;
            }
            section {
                min-height: 70vh;
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
            h2 {
                font-family: 'Poppins','sans-serif';
                font-weight:300;
                font-size:2em;
                color:white;
                letter-spacing: 0.25em;
                width:80%;
                margin-left: 5%;
                margin-top:2%;
            }
            table {
                margin-top: 2%;
                width:50%;
                margin-left:5%
            }

            td a,
            td {
                text-decoration: none;
                color: white;
                font-size: 1.25em;
                letter-spacing: 0.1em;
                font-family: "Poppins", "sans-serif";
                font-weight: 300;
                width:20%;
            }
            th {
                font-family: "Poppins", "sans-serif";
                font-weight: 300;
                font-size: 2em;
                letter-spacing: 0.2em;
                font-weight: 500;
                text-align: left;
                color: white;

            }

            td:hover,
            td a:hover {
                color: #085a57;
            }
            #btn {
                border-radius: 10px;
                border: none;
                width: 50%;
                margin-left: 25%;
                background-color: #085a57;
                color: white;
                padding: 2%;
                font-size: 0,75em;
                letter-spacing: 0.1em;
            }
            #btn:hover {
                color:white;
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
    <section id="bookings">
    <h1>My Bookings</h1>
                <?php if(!empty($bookings)) { ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Destination</th>
                            <th scope="col">Booking Date</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php foreach($bookings as $booking) { 
                                    $sql = "SELECT destinationName FROM destinations WHERE destinationID = :destinationID";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':destinationID', $booking['destinationID']);
                                    $stmt->execute();
                                    $destinationName = $stmt->fetchColumn();?>
                            <tr>
                                <td> <a href="details.php?name=<?php echo $destinationName; ?>"><?php echo $destinationName;?> </a> </td>
                                <td><?php echo $booking['bookingDate']?></td>
                            </tr>
                        <?php }                             
                        } else { ?>
                            <h2>You have no bookings.</h2> <?php
                        } ?>
                    </tbody>
                </table>
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
<?php }else{
  header("Location: login.php");
  exit;
} ?>