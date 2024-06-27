<?php
    include "db_connect.php";
    include "arrangement_functions.php";
    $id=1;
    $destinations=get_destinations_by_category($conn,$id);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                background: linear-gradient(rgb(8,90,87), rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
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
                    <a href="home.php"><li>Home</li></a>
                    <a href="summer.php"><li>Summer</li></a>
                    <a href="winter.php"><li>Winter</li></a>
                    <a href="spring.php"><li>Spring</li></a>
                    <a href="fall.php"><li>Fall</li></a>
                    <a href="login.php"><li>Login</li></a>
                </ul>
            </nav>
            <h1>SPRING</h1>
            <div class="filter">
                <form method="get" action="searchDestinations.php">
                <input type="hidden" name="id" value="1">
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
                            <h4 class="price"><?php echo $dest['price']; ?> &#8364;</h4>
                        </div>
                    </div>
                </a>
                <?php } ?>
            </section>
            <footer>
                <p>&copy 2024</p>
            </footer>
    </body>
</html>
