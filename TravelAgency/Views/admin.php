<?php
session_start();
require_once("../Functions/https_secure_connection.php");

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])
) {

    include "../config/db_connect.php";
    include "../Models/category_functions.php";
    include "../Models/arrangement_functions.php";
    include "../Models/booking_functions.php";
    $categories = get_categories($conn);
    $arrangements = get_arrangements($conn);
    $bookings = get_bookings($conn);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="../style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <style>
            body {
                background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
                min-height: 100vh;
            }

            .categories {
                width: 80%;
                margin-left: 10%;
                margin-right: 10%;
            }

            h1 {
                font-family: 'Poppins', 'sans-serif';
                font-size: 3em;
                letter-spacing: 0.2em;
                font-weight: 500;
                color: white;
                text-align: center;
                margin-bottom:5%;
                margin-top:3%;
            }

            h2 {
                font-family: 'Poppins', 'sans-serif';
                font-size: 2em;
                letter-spacing: 0.1em;
                font-weight: 300;
                color: white;
            }

            .btn.btn-primary {
                width: 45%;
                float: left;
                color: white;
                margin: 2%;
            }

            .card.text-center {
                width: 20%;
                float: left;
                margin: 2%;
            }

            .card-title {
                font-family: "Poppins", "sans-serif";
                font-weight: 500;
                font-size: 2em;
                letter-spacing: 0.2em;
            }

            .fontExtra {
                font-family: 'Poppins', 'sans-serif';

            }

            .adminButton {
                text-decoration: none;
                color: white;
                font-family: 'Poppins', 'sans-serif';
                font-weight: 100;
                font-size: 1.5em;
                letter-spacing: 0.1em;
            }

            #add_category {
                background-color: #085a57;
                color: white;
                border: none;
                margin-left: 12.5%;
                font-size: 1.5em;
                font-weight: 300;
                margin-top: 2.5%;
                margin-bottom: 2.5%;
            }

            table {
                margin-top: 2%;
            }

            th,
            td a,
            td {
                text-decoration: none;
                color: white;
                font-size: 1.2em;
                font-family: "Poppins", "sans-serif";
                font-weight: 300;
            }

            th {
                font-size: 1.5em;
                font-weight: 500;
            }

            td:hover,
            td a:hover {
                color: #085a57;
            }

            #dest {
                width: 30%;
            }

            #btn {
                border-radius: 10px;
                border: none;
                width: 50%;
                margin-left: 25%;
                background-color: #085a57;
                color: white;
                padding: 2%;
                font-size: 1em;
                letter-spacing: 0.1em;
            }

            #btn a:hover {
                color: white;
            }

            #btn_add {
                border-radius: 10px;
                border: none;
                width: 20%;
                background-color: #085a57;
                color: white;
                font-size: 1.5em;
                letter-spacing: 0.1em;
                padding: 1%;
            }

            #btn_add a {
                color: white;
                text-decoration: none;
            }

            #btn1 {
                border-radius: 10px;
                border: none;
                width: 45%;
                margin-left: 2%;
                background-color: #085a57;
                color: white;
                font-size: 0.8em;
                padding: 1%;
            }

            #btn1 a:hover {
                color: white;
            }
        </style>


    </head>

    <body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="#all_categories">Categories</a></li>
            <li><a href="#all_dest">Arrangements</a></li>
            <li><a href="#all_booking">Bookings</a></li>
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
        <div class="mt-5"></div>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($_GET['success']); ?>
            </div>
        <?php } ?>

        <h1 id="all_categories">All Categories</h1>
        <div class="categories">
            <?php
            foreach ($categories as $category) {
                $pageName = strtolower($category['categoryName']) . '.php';
            ?>
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($category['categoryName']); ?></h5>
                        <button id="btn1">
                            <a href="<?php echo $pageName; ?>" class="adminButton">Details</a>
                        </button>
                        <button id="btn1">
                            <a href="../Functions/delete_category.php?id=<?php echo $category['categoryID']; ?>" class="adminButton">Delete all</a>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <h1 id="all_dest">All arrangements</h1>
        <div class="arrangements">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Destination Name</th>
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arrangements as $arrangement) { ?>
                        <tr>
                            <td id="dest">
                                <a href="details.php?name=<?php echo $arrangement['destinationName']; ?>">
                                    <?php echo $arrangement['destinationName'] ?>
                                </a>
                            </td>
                            <td><?php echo $arrangement['fromDate'] ?></td>
                            <td><?php echo $arrangement['toDate'] ?></td>
                            <td><?php echo $arrangement['price'] ?> €</td>
                            <td>
                                <button id="btn"><a href="editDestination.php?name=<?php echo $arrangement['destinationName'] ?>">Edit</a></button>
                            </td>
                            <td>
                                <button id="btn"><a href="../Functions/deleteDestination.php?id=<?php echo $arrangement['destinationID'] ?>">Delete</a></button>
                            </td>
                            <td>
                                <button id="btn"><a href="details.php?name=<?php echo $arrangement['destinationName'] ?>">Details</a></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <h1 id="all_booking">All bookings</h1>
        <div class="bookings">
            <?php if (!empty($bookings)) { ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Booking ID</th>
                            <th scope="col">Destination</th>
                            <th scope="col">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking) {
                                    $sql = "SELECT destinationName FROM destinations WHERE destinationID = :destinationID";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':destinationID', $booking['destinationID']);
                                    $stmt->execute();
                                    $destinationName = $stmt->fetchColumn();
                                    $sql = "SELECT firstName, lastName FROM users WHERE userID = :userID";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':userID', $booking['userID']);
                                    $stmt->execute();
                                    $user = $stmt->fetch();
                                    $userName = $user['firstName'] . " " . $user['lastName'];
                                    ?>
                            <tr>
                                <td><?php echo $booking['bookingID'] ?></td>
                                <td id="dest">
                                    <a href="details.php?name=<?php echo $destinationName; ?>">
                                        <?php echo $destinationName; ?>
                                    </a>
                                </td>
                                <td><?php echo $userName; ?></td>
                            </tr>
                        <?php }
                    } else {
                        ?> <h2>No bookings found.</h2> <?php
                                                    } ?>
                    </tbody>
                </table>
        </div>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
    exit;
} ?>