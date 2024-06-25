<?php
include "db_connect.php";
include "category_functions.php";
$categories = get_categories($conn);
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
            width:25%;
            float:left;
            color:white;
            margin:2%;
        }
        .card.text-center {
            width:45%;
            float:left;
            margin-right: 2.5%;
            margin-left:2.5%;
            margin-bottom: 2%;
            margin-top:2%;
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
                    <a href="summer.php"><li>Summer</li></a>
                    <a href="winter.php"><li>Winter</li></a>
                    <a href="spring.php"><li>Spring</li></a>
                    <a href="fall.php"><li>Fall</li></a>
                    <a href="login.php"><li>Login</li></a>
                </ul>
        </nav>
       <form action="search.php" method="get" style="width: 100%; max-width: 30rem">
       	<div class="input-group my-5">
		  <input type="text" class="form-control" name="key" placeholder="Search Category or Arrangement...">
		  <button class="input-group-text btn btn-primary">SEARCH</button>
		</div>
       </form>

       		<a class ="btn btn-danger" href="add_arrangement.php">Add arrangement</a>
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

		<h4>All Categories</h4>
        <a class ="btn btn-danger" id="add_category" href="add_category.php">Add Category</a> 
        <div class="categories">
                <?php 
                $i = 0;
                foreach ($categories as $category) {
                    $i++;
            ?>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($category['categoryName']); ?></h5>
                    <button class="btn btn-primary"><a href="edit_category.php?id=<?php echo $category['categoryID']; ?>" class="adminButton">Edit</a></button>
                    <button class="btn btn-primary"><a href="category_details.php?id=<?php echo $category['categoryID']; ?>" class="adminButton">Details</a></button>
                    <button class="btn btn-primary"><a href="delete_category.php?id=<?php echo $category['categoryID']; ?>"class="adminButton">Delete</a></button>
                </div>
            </div>
                <?php } ?>
        </div>


</body>
</html>
