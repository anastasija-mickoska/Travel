<?php
session_start();

include "db_connect.php";
include "arrangement_functions.php";
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name']; 
} else {
    $name = 'Mykonos';
}
$destination = get_destination_by_name($conn, $name);

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
            padding: 0;
        }

        section {
            display: block;
        }

        #detailpage {
            height: 100vh;
            background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
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
        .btn {
            display: inline-block;
            border-radius:10px;
            border:none;
            width:20%;
            background-color: #085a57;
            color:white;
            padding:2%;
            font-size:1.5em;
            letter-spacing: 0.1em;
           
        }
    </style>
</head>

<body>
    <section id="detailpage">
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

        <div class="w-full gap-10 flex items-center" style="height: 700px;">
            <div class=" w-1/2  flex flex-col items-start gap-5 bg-white opacity-60 rounded-xl p-5">
                <div style="font-family: Poppins,sans-serif;" class="font-bold  text-3xl"><?php echo $destination['destinationName']; ?></div>
                <div style="font-family: Poppins,sans-serif;" class="font-semibold w-full text-left text-xl">From: <?php echo $destination['fromDate']; ?> To: <?php echo $destination['toDate']; ?></div>
                <div style="font-family: Poppins,sans-serif;" class="w-full text-left text-xl"><?php echo $destination['description']; ?></div>
                <div style="font-family: Poppins,sans-serif;" class="w-full text-left text-xl font-bold">Price: <?php echo $destination['price']; ?>$</div>
                <button class="btn"> <a href="bookingForm.php?destinationName=<?php echo $destination['destinationName']; ?>"> Book Now </a></button>
                <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type']==='admin') { ?>
                <button class="btn"> <a href="editDestination.php?name=<?php echo $destination['destinationName']; ?>"> Edit </a></button> <?php } ?>
            </div>
            <div class="w-1/2 h-full flex items-center justify-center relative">
                <img class="rounded-xl border-solid border-white border-2" src="<?php echo $destination['imgUrl']; ?>" alt="img" style="width: 100%; height: 70%;">
            </div>
        </div>
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
