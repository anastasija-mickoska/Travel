<?php
include "../config/db_connect.php";
require_once("../Functions/https_secure_connection.php");
session_start();
if ( isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
$destinationName = $_GET['destinationName'] ?? '';
$user=$_SESSION['user_id'];

$destPriceQuery = $conn->prepare("SELECT price FROM destinations WHERE destinationName = :destinationName");
$destPriceQuery->bindParam(':destinationName', $destinationName);
$destPriceQuery->execute();
$destPrice = $destPriceQuery->fetchColumn();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
        }
        .bookingForm {
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
            width:100%;
        }
        input {
            width: 100%;
            padding: 1%;
            border-radius: 5px;
            background-color: white;
            font-size: 1em;
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            color: black;
            margin-bottom: 2%;
        }
        form {
            margin-top: 10%;
            width: 100%;
        }
        input[type="submit"] {
            border-radius: 10px;
            border: none;
            width: 50%;
            margin-top:5%;
            background-color: #085a57;
            color: white;
            padding: 2%;
            font-size: 1.5em;
            letter-spacing: 0.1em;
            margin-left:25%;
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
        span {
            font-family: 'Poppins', 'sans-serif';
            font-weight: 300;
            font-size: 1.5em;
            color: black;
            letter-spacing: 0.1em;
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
<div class="bookingForm">
        <h1>Fill out the booking form</h1>
        <form method="post" action="../Functions/addBooking.php">
            <div class="mb-5">
                <label for="fullName" style="font-family: Poppins,sans-serif;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label> <br>
                <input type="text" name="fullName" style="font-family: Poppins,sans-serif;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div class="mb-5">
                <label for="email" style="font-family: Poppins,sans-serif;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mail</label><br>
                <input type="email" name="email" style="font-family: Poppins,sans-serif;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div class="mb-5">
                <label for="phoneNumber" style="font-family: Poppins,sans-serif;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label><br>
                <input type="tel" name="phoneNumber" style="font-family: Poppins,sans-serif;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div class="mb-5">
                <label for="destination" style="font-family: Poppins,sans-serif;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination:</label><br>
                <input type="text" name="destination" value="<?php echo $destinationName; ?>" style="font-family: Poppins,sans-serif;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
            </div>
            <div class="mb-5">
                <label for="numberOfAdults" style="font-family: Poppins,sans-serif;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Number of Adults</label><br>
                <input type="number" name="numberOfAdults" id="adults" style="font-family: Poppins,sans-serif;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div class="mb-5">
                <label for="numberOfChildren" style="font-family: Poppins,sans-serif;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Number of Children</label><br>
                <input type="number" name="numberOfChildren" id="children" style="font-family: Poppins,sans-serif;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-5">
                <label for="numberOfInfants" style="font-family: Poppins,sans-serif;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Number of Infants</label><br>
                <input type="number" name="numberOfInfants" id="infants" style="font-family: Poppins,sans-serif;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <label>Total:</label>
            <span id="total">0 €</span> <br>

            <input type="submit" value="Book Now">
        </form>
    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pricePerAdult = <?php echo $destPrice; ?>;
            const pricePerChild = 0.5 * <?php echo $destPrice; ?>;
            const pricePerInfant = 0;

            const adultsInput = document.getElementById('adults');
            const childrenInput = document.getElementById('children');
            const infantsInput = document.getElementById('infants');
            const totalSumDisplay = document.getElementById('total');

            function calculateTotalSum() {
                const adults = parseInt(adultsInput.value) || 0;
                const children = parseInt(childrenInput.value) || 0;
                const infants = parseInt(infantsInput.value) || 0;

                const totalSum = (adults * pricePerAdult) + (children * pricePerChild) + (infants * pricePerInfant);
                totalSumDisplay.innerHTML = totalSum + " €";
            }

            adultsInput.addEventListener('input', calculateTotalSum);
            childrenInput.addEventListener('input', calculateTotalSum);
            infantsInput.addEventListener('input', calculateTotalSum);

            calculateTotalSum(); 
        });
    </script>
</body>
</html>
<?php } else {
    header("Location: login.php");
    exit;
} ?>