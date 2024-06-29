<?php
session_start();
include "db_connect.php";
include "arrangement_functions.php";
    $id=3;
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
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .open-modal-btn {
            background-color: #085a57;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            position: fixed;
            bottom: 20px;
            right: 20px;
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
                        <?php if (isset($_SESSION['user_email']) && isset($_SESSION['user_id'])): ?>
                            <li style="color:white; font-family:Poppins; font-weight:100; width:20%"><?php echo $_SESSION['user_email']; ?></li>
                            <a href="myBookings.php?userID=<?php echo $_SESSION['user_id'];?>"><li>My Bookings</li></a>
                            <a href="logout.php"><li>Logout</li></a>
                        <?php else: ?>
                            <a href="login.php"><li>Login</li></a>
                        <?php endif; ?>                    
                    </ul>
                </nav>
    <h1>FALL</h1>
    <div class="filter">
        <form method="get" action="searchDestinations.php?">
        <input type="hidden" name="id" value="3">
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
    <button class="open-modal-btn">Add Category</button>
    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Category</h2>
            <form>
                <label for="categoryName">Category Name</label><br>
                <input type="text" id="categoryName" name="categoryName"><br><br>
                <input type="submit" value="Add Category">
            </form>
        </div>
    </div>
    <script>
        var modal = document.getElementById("addCategoryModal");
        var btn = document.querySelector(".open-modal-btn");
        var span = document.querySelector(".close");
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
            <?php foreach($destinations as $dest) { ?>
                <a href="destination_details.php?id=<?php echo $dest['destinationID']; ?>">
                    <div class="arr1" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $dest['imgUrl'];?>') no-repeat center center/cover;" >
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