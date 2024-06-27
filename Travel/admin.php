<?php
include "db_connect.php";
include "category_functions.php";
include "arrangement_functions.php";
$categories = get_categories($conn);
$arrangements=get_arrangements($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
    <link rel="stylesheet" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
            min-height: 100vh;
        }
        section {
            width:100%;
            float:left;
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
    </style>


</head>
<body>
        <nav>
            <ul>
                    <a href="home.php"><li>Home</li></a>
                    <a href="#categories"><li>Categories</li></a>
                    <a href="#allDestinations"><li>Arrangements</li></a>
                    <a href="#allBookings"><li>Bookings</li></a>
                </ul>
        </nav>
       <form action="search.php" method="get" style="width: 100%; max-width: 30rem">
       	<div class="input-group my-5">
		  <input type="text" class="form-control" name="key" placeholder="Search Category or Arrangement...">
		  <button class="input-group-text btn btn-primary">SEARCH</button>
		</div>
       </form>
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
        <section id="categories">
            <h4 id="allDestinations">All Categories</h4>
            <div class="categories">
                <?php 
                foreach ($categories as $category) {
                    $pageName = strtolower($category['categoryName']) . '.php';
                ?>
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($category['categoryName']); ?></h5>
                        <button class="btn btn-primary">
                            <a href="<?php echo $pageName; ?>" class="adminButton">Details</a>
                        </button>
                        <button class="btn btn-primary">
                            <a href="delete_category.php?id=<?php echo $category['categoryID']; ?>" class="adminButton">Delete all</a>
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <section id="destinations">
            <h4 id="allDestinations">All arrangements</h4>
            <a class ="btn btn-danger" href="add_arrangement.php">Add arrangement</a>
            <div class="arrangements">
                <?php 
                foreach($arrangements as $arrangement) { ?>
                    <a href="arrangement_details.php?id=<?php echo $arrangement['destinationID']?>">
                        <div class="arr1" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $arrangement['imgUrl'];?>') no-repeat center center/cover;" >
                            <div class="desc">
                                <h3><?php echo $arrangement['destinationName']?></h3>
                                <h4><i><?php echo $arrangement['fromDate']?> - <?php echo $arrangement['toDate']?></i></h4>
                                <h4 class="price"><?php echo $arrangement['price']?></h4>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </section>
        <section id="bookings">
            <h4 id="allBookings">All bookings</h4>
        </section>
</body>
</html>
