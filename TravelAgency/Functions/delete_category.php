<?php  
	include "../config/db_connect.php";
    include "../Models/category_functions.php";
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		if (empty($id)) {
			$error = "Error Occurred!";
			header("Location: ../Views/admin.php?error=$error");
            exit;
		}else {
            $category = get_category_by_id($conn, $id);
            if ($category) {
                $query = "DELETE FROM destinations WHERE categoryID = ?";
                $queryExec = $conn->prepare($query);
                $result = $queryExec->execute([$category['categoryID']]);
		     if ($result) {
		     	$success = "Successfully removed!";
				header("Location: ../Views/admin.php?success=$success");
	            exit;
			 }else {
			 	$error = "Error Occurred!";
			    header("Location: ../Views/admin.php?error=$error");
                exit;
			 }
		}
	}
    }
    else {
      header("Location: ../Views/admin.php");
      exit;
	}