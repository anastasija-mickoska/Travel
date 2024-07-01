<?php  
	include "../config/db_connect.php";
    include "../Models/arrangement_functions.php";
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		if (empty($id)) {
			$error = "Error Occurred!";
			header("Location: ../Views/admin.php?error=$error");
            exit;
		}else {
            $destination = get_destination_by_id($conn, $id);
            if ($destination) {
                $query = "DELETE FROM destinations WHERE destinationID = ?";
                $queryExec = $conn->prepare($query);
                $result = $queryExec->execute([$destination['destinationID']]);
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