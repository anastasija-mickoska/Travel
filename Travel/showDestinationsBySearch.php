<?php
    include "db_connect.php";
    include "arrangement_functions.php";
    $destination=search_destinations_homepage($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh; 
                background: 
                    linear-gradient(rgba(8, 90, 87, 0.8), rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
            }
            h2 {
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
                        <a href="home.php"><li>Home</li></a>
                        <a href="summer.php"><li>Summer</li></a>
                        <a href="winter.php"><li>Winter</li></a>
                        <a href="spring.php"><li>Spring</li></a>
                        <a href="fall.php"><li>Fall</li></a>
                        <a href="login.php"><li>Login</li></a>
                    </ul>
                </nav>
            <h2>Search results</h2>
            <section class="arr">
            <?php 
            if(empty($destination)) { ?>
                <h3> <?php echo "No results were found based on this search.";  ?> </h3> <?php
            }
            else {
             foreach($destination as $dest) { ?>
                <a href="destination_details.php?id=<?php echo $dest['destinationID']; ?>">
                    <div class="arr1" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $dest['imgUrl'];?>') no-repeat center center/cover;" >
                        <div class="desc">
                            <h3><?php echo $dest['destinationName']; ?></h3>
                            <h4><i><?php echo $dest['fromDate']; ?> - <?php echo $dest['toDate']; ?> </i></h4>
                            <h4 class="price"><?php echo $dest['price']; ?></h4>
                        </div>
                    </div>
                </a>
            <?php }  }?>
            </section>
    </body>
</html>
