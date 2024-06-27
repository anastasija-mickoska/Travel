<?php
include "db_connect.php";
include "arrangement_functions.php";
$id = 2;
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
            <a href="home.php">
                <li>Home</li>
            </a>
            <a href="summer.php">
                <li>Summer</li>
            </a>
            <a href="winter.php">
                <li>Winter</li>
            </a>
            <a href="spring.php">
                <li>Spring</li>
            </a>
            <a href="fall.php">
                <li>Fall</li>
            </a>
            <a href="login.php">
                <li>Login</li>
            </a>
        </ul>
    </nav>
    <h1>SUMMER</h1>
    <div class="filter">
        <form method="get" action="search_destinations_by_category.php">
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
    <button class="open-modal-btn" onclick="document.getElementById('addDestinationModal').style.display='block'">Add Destination</button>

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
        // JavaScript to control modal display
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
            <a href="destination_details.php?id=<?php echo $dest['destinationID']; ?>">
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
    <footer>
        <p>&copy 2024</p>
    </footer>
</body>

</html>