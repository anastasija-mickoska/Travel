<?php
session_start();
    include "db_connect.php";
    include "arrangement_functions.php";
    $search=search_destinations_by_category($conn);
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
        h3 {
                font-family: 'Poppins','sans-serif';
                font-weight:300;
                font-size:1.75em;
                color:white;
                letter-spacing: 0.1em;
                width:80%;
                margin-left: 5%;
                margin-top:2%;
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
        <h1>Search results</h1>
            <section class="arr">
            <?php if(!empty($search)) {
            foreach($search as $dest) { ?>
                <a href="destination_details.php?id=<?php echo $dest['destinationID']; ?>">
                    <div class="arr1" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $dest['imgUrl'];?>') no-repeat center center/cover;" >
                        <div class="desc">
                            <h3><?php echo $dest['destinationName']; ?></h3>
                            <h4><i><?php echo $dest['fromDate']; ?> - <?php echo $dest['toDate']; ?> </i></h4>
                            <h4 class="price"><?php echo $dest['price']; ?> &#8364;</h4>
                        </div>
                    </div>
                </a>
                <?php } }
            else { ?>
                <h3> <?php echo "No results were found based on this search.";  ?> </h3> <?php
            } ?>
            </section>
            <footer>
                <p>&copy 2024</p>
            </footer>
    </body>
</html>