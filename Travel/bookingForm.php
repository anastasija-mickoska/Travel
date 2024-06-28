<?php
include "db_connect.php";

$destinationName = $_GET['destinationName'] ?? '';
$destinationName = htmlspecialchars($destinationName, ENT_QUOTES, 'UTF-8');

$destPriceQuery = $conn->prepare("SELECT price FROM destinations WHERE destinationName = :destinationName");
$destPriceQuery->bindParam(':destinationName', $destinationName);
$destPriceQuery->execute();
$destPrice = $destPriceQuery->fetchColumn();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
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
        }
        input {
            width: 30%;
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
            <a href="home.php"><li>Home</li></a>
            <a href="summer.php"><li>Summer</li></a>
            <a href="winter.php"><li>Winter</li></a>
            <a href="spring.php"><li>Spring</li></a>
            <a href="fall.php"><li>Fall</li></a>
            <a href="login.php"><li>Login</li></a>
        </ul>
    </nav>
    <div class="bookingForm">
        <h1>Fill out the booking form</h1>
        <form method="post" action="addBooking.php">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required> <br>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required> <br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required> <br>

            <label for="destination">Destination:</label>
            <input type="text" id="destinationName" name="destinationName" value="<?php echo $destinationName; ?>" readonly> <br>

            <label for="adults">Number of Adults:</label>
            <input type="number" id="adults" name="adults" min="1" required> <br>

            <label for="children">Number of Children:</label>
            <input type="number" id="children" name="children" min="0"> <br>

            <label for="infants">Number of Infants:</label>
            <input type="number" id="infants" name="infants" min="0"> <br>

            <label>Total:</label>
            <span id="total">0 €</span> <br>

            <input type="submit" value="Book Now">
        </form>
    </div>
    <footer class="body-container">
        <div class="footer-element">
            <h2>Logo</h2>
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
