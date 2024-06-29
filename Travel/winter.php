<?php
session_start();
include "db_connect.php";
include "arrangement_functions.php";
$id = 4;
$destinations = get_destinations_by_category($conn, $id);
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
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 50px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        .modal-content label {
                font-family:'Poppins','sans-serif';
                font-weight:300;
                font-size:1.5em;
                letter-spacing:0.2em;
                margin-bottom:10%;
        }
        .modal-content input {
                width:45%;
                padding:1%;
                border-radius:5px;
                background-color:white;
                font-size:1em;
                font-family: 'Poppins','sans-serif';
                font-weight:300;
                color:black;
        }
        .modal-content input[type="submit"] {
            background-color: #085a57;
            color:white;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .open-modal-btn {
            border-radius:10px;
            margin-left:5%;
            font-family: "Poppins","sans-serif";
            font-weight: 300;
            font-size:1.25em;
            letter-spacing: 0.1em;
            width:20%;
            border-radius: 5px;
            background-color: #085a57;
            color: white;
            padding: 1%;
            border: none;
            cursor: pointer;
        }
        h2 {
            font-family:"Poppins","sans-serif";
            font-weight: 300;
            font-size:2em;
            text-decoration: underline 1px;
            margin-bottom:2%;
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
    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') { ?>
            <button class="open-modal-btn" onclick="document.getElementById('addDestinationModal').style.display='block'">Add Destination</button>
            <?php } ?>
    <div id="addDestinationModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="document.getElementById('addDestinationModal').style.display='none'">&times;</span>
                    <h2>Add Destination</h2>
                    <form action="addDestination.php" method="post">
                        <label for="destinationName">Destination Name</label><br>
                        <input type="text" id="destinationName" name="destinationName" required><br><br>

                        <label for="fromDate">From Date</label><br>
                        <input type="date" id="fromDate" name="fromDate" required><br><br>

                        <label for="toDate">To Date</label><br>
                        <input type="date" id="toDate" name="toDate" required><br><br>

                        <label for="description">Description</label><br>
                        <textarea id="description" name="description" rows="4" required></textarea><br><br>

                        <label for="price">Price</label><br>
                        <input type="text" id="price" name="price" required><br><br>

                        <label for="location">Location</label><br>
                        <input type="text" id="location" name="location" required><br><br>

                        <label for="imgUrl">Image URL</label><br>
                        <input type="text" id="imgUrl" name="imgUrl" required><br><br>

                        <input type="submit" value="Add Destination">
                    </form>
                </div>
            </div>
            <script>
                var modal = document.getElementById('addDestinationModal');
                var btn = document.querySelector('.open-modal-btn');
                var span = document.getElementsByClassName('close')[0];

                btn.onclick = function() {
                    modal.style.display = "block";
                }

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>    
    <section class="arr">
        <?php foreach ($destinations as $dest) { ?>
            <a href="details.php?id=<?php echo $dest['destinationID']; ?>&name=<?php echo urlencode($dest['destinationName']); ?>">
                <div class="arr1" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $dest['imgUrl']; ?>') no-repeat center center/cover;">
                    <div class="desc">
                        <h3><?php echo $dest['destinationName']; ?></h3>
                        <h4><i><?php echo $dest['fromDate']; ?> - <?php echo $dest['toDate']; ?> </i></h4>
                        <h4 class="price"><?php echo $dest['price']; ?> &#8364;</h4>
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
