<!-- <!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Destination</title>
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
    <h1>Edit Destination</h1>
    <form method="post" action="updateDestination.php">
        <div class="Forms">
            <label for="destinationName">Destination Name</label> <br>
            <input type="text" name="destinationName" required>
        </div>
        <div class="Forms">
            <label for="destinationSeason">Season</label> <br>
            <select name="destinationSeason">
                <option value="Summer">Summer</option>
                <option value="Winter">Winter</option>
                <option value="Spring">Spring</option>
                <option value="Fall">Fall</option>
            </select>
        </div>
        <div class="Forms">
            <label for="priceRange">Price Range</label> <br>
            <select name="priceRange">
                <option value="0-100">0-100</option>
                <option value="101-200">101-200</option>
                <option value="201-300">201-300</option>
                <option value="301-400">301-400</option>
                <option value="401-500">401-500</option>
                <option value="500+">500+</option>
            </select>
        </div>
        <div class="Forms">
            <input type="submit" value="Update Destination" id="searchButton">
        </div>
    </form>
</body>

</html> -->