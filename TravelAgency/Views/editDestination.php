<?php
session_start();
require_once("../Functions/https_secure_connection.php");
include "../config/db_connect.php";
include "../Models/arrangement_functions.php";
$name = $_GET['name'];
$destination = get_destination_by_name($conn, $name);
 
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
<title>Edit Destination</title>
    <style>
        body {
            background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
            min-height:100vh;
        }
        h1 {
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
        form {
            margin-top:5%;
        }
        #search {
            width: 70%;
            height: 150px;
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 2%;
        }

        .Forms {
            width: 50%;
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
            padding: 1%;
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
            width: 25%;
            border-radius: 5px;
            border: none;
            margin-top: 2.5%;
            padding: 1.4%;
            background-color: #085a57;
            opacity: 1;
            color: white;
            font-family: "Poppins","sans-serif";
            font-weight: 300;
            letter-spacing: 0.1em;
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
    <h1><?php echo $destination['destinationName']; ?></h1>
    <form method="post" enctype="multipart/form-data" action="../Functions/updateDestination.php?name=<?php echo $name; ?>">
        <div class="Forms">
            <label for="destinationName">Destination Name</label> <br>
            <input type="text" name="destinationName" value="<?php echo $destination['destinationName']; ?>">
        </div>
        <div class="Forms">
            <label for="categoryID">Category</label> <br>
            <input type="text" name="categoryID" value="<?php echo $destination['categoryID']; ?>">
        </div>
        <div class="Forms">
            <label for="fromDate">From</label> <br>
            <input type="date" name="fromDate" value="<?php echo $destination['fromDate']; ?>">
        </div>
        <div class="Forms">
            <label for="toDate">To</label> <br>
            <input type="date" name="toDate" value="<?php echo $destination['toDate']; ?>">
        </div>
        <div class="Forms">
            <label for="description">Description</label> <br>
            <input type="text" name="description" value="<?php echo $destination['description']; ?>">
        </div>
        <div class="Forms">
            <label for="price">Price</label> <br>
            <input type="text" name="price" value="<?php echo $destination['price']; ?>">
        </div>
        <div class="Forms">
            <label for="location">Location</label> <br>
            <input type="text" name="location" value="<?php echo $destination['location']; ?>">
        </div>
        <div class="Forms">
            <label for="imgUrl">Image</label> <br>
            <input type="file" name="imgUrl">
        </div>
        <div class="Forms">
            <input type="submit" value="Update Destination" id="searchButton">
        </div>
    </form>
</body>

</html>