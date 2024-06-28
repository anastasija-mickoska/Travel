<?php
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

    include "db_connect.php";
    include "category_functions.php";
    include "arrangement_functions.php";
    $categories = get_categories($conn);
    $arrangements=get_arrangements($conn);
    //$bookings=get_bookings($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.php">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
            min-height: 100vh;
        }
        .categories {
            width:80%;
            margin-left:10%;
            margin-right:10%;
        }
        h4 {
            font-family: 'Poppins','sans-serif';
            font-size: 3em;
            letter-spacing: 0.2em;
            font-weight:500;
            color:white;
            text-align: center;
        }
        .btn.btn-primary {
            width:45%;
            float:left;
            color:white;
            margin:2%;
        }
        .card.text-center {
            width:20%;
            float:left;
            margin:2%;
        }
        .card-title {
            font-family: "Poppins","sans-serif";
            font-weight: 500;
            font-size:1.5em;
        }
        .adminButton {
            text-decoration: none;
            color:white;
            font-family: 'Poppins','sans-serif';
            font-weight: 100;
            font-size:1.5em;
            letter-spacing: 0.1em;
        }
        #add_category {
            background-color: #085a57;
            color:white;
            border:none;
            margin-left:12.5%;
            font-size:1.5em;
            font-weight: 300;
            margin-top:2.5%;
            margin-bottom:2.5%;
        }
        table {
            margin-top:2%;
        }
        th, td a, td {
            text-decoration: none;
            color:white;
            font-size:1.2em;
            font-family:"Poppins","sans-serif";
            font-weight: 300;
        }
        th {
            font-size:1.5em;
            font-weight: 500;
        }
        td:hover, td a:hover {
            color:#085a57;
        }
        #dest {
            width:30%;
        }
        #btn {
                border-radius:10px;
                border:none;
                width:50%;
                margin-left:25%;
                background-color: #085a57;
                color:white;
                padding:2%;
                font-size:1em;
                letter-spacing: 0.1em;
        }
        #btn a:hover {
            color:white;
        }
        #btn_add {
                border-radius:10px;
                border:none;
                width:20%;
                background-color: #085a57;
                color:white;
                font-size:1.5em;
                letter-spacing: 0.1em;
                padding: 1%;
        }
        #btn_add a{
            color:white;
            text-decoration: none;
        }
        #btn1 {
                border-radius:10px;
                border:none;
                width:45%;
                margin-left:2%;
                background-color: #085a57;
                color:white;
                font-size:1em;
                padding: 1%;
        }
        #btn1 a:hover {
            color:white;
        }
    </style>


</head>
<body>
                <nav>
                    <ul>
                        <a href="home.php"><li>Home</li></a>
                        <a href="#all_categories"><li>Categories</li></a>
                        <a href="#all_booking"><li>Bookings</li></a>
                        <a href="#all_dest"><li>Arrangements</li></a>
                        <?php if (isset($_SESSION['user_email'])): ?>
                            <a href="admin.php"><li style="color:white; font-family:Poppins; font-weight:100"><?php echo $_SESSION['user_email']; ?></li></a>
                            <a href="logout.php"><li>Logout</li></a>
                        <?php else: ?>
                            <a href="login.php"><li>Login</li></a>
                        <?php endif; ?>                    
                    </ul>
                </nav>
       <div class="mt-5"></div>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>

		<h4 id="all_categories">All Categories</h4>
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
                        <a href="delete_category.php?id=<?php echo $category['categoryID']; ?>" class="adminButton">Delete all</a>
                    </button>
                </div>
            </div>
            <?php } ?>
        </div>
        <h4 id="all_dest">All arrangements</h4>
        <button id="btn_add"><a href="add_arrangement.php">Add arrangement</a></button>
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
                    <?php foreach($arrangements as $arrangement) { ?>
                        <tr>
                            <td id="dest">
                                <a href="arrangement_details.php?id=<?php echo $arrangement['destinationID'];?>">
                                    <?php echo $arrangement['destinationName']?>
                                </a>
                            </td>
                            <td><?php echo $arrangement['fromDate']?></td>
                            <td><?php echo $arrangement['toDate']?></td>
                            <td><?php echo $arrangement['price']?> €</td>
                            <td>
                                <button id="btn"><a href="editDestination.php?id=<?php echo $arrangement['destinationID']?>">Edit</a></button>
                            </td>
                            <td>
                                <button id="btn"><a href="deleteDestination.php?id=<?php echo $arrangement['destinationID']?>">Delete</a></button>
                            </td>
                            <td>
                                <button id="btn"><a href="destination_details.php?id=<?php echo $arrangement['destinationID']?>">Details</a></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <h4 id="all_booking">All bookings</h4>
        <div class="bookings">
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Booking ID</th>
                        <th scope="col">Destination</th>
                        <th scope="col">User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bookings as $booking) { ?>
                        <tr>
                            <td><?php echo $booking['bookingID']?></td>
                            <td id="dest">
                                <a href="arrangement_details.php?id=<?php echo $booking['destinationID'];?>">
                                    <?php echo $booking['destinationID']?>
                                </a>
                            </td>
                            <td><?php echo $booking['userID']?></td>
                            <td>
                                <button id="btn"><a href="deleteBooking.php?id=<?php echo $booking['destinationID']?>">Delete</a></button>
                            </td>
                            <td>
                                <button id="btn"><a href="bookingDetails.php?id=<?php echo $booking['bookingID']?>">Details</a></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</body>
</html>
<?php }else{
  header("Location: login.php");
  exit;
} ?>