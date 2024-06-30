<?php  
	include "db_connect.php";
    include "arrangement_functions.php";
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		if (empty($id)) {
			$error = "Error Occurred!";
			header("Location: admin.php?error=$error");
            exit;
		}else {
            $destination = get_destination_by_id($conn, $id);
            if ($destination) {
                $query = "DELETE FROM destinations WHERE destinationID = ?";
                $queryExec = $conn->prepare($query);
                $result = $queryExec->execute([$destination['destinationID']]);
		     if ($result) {
		     	$success = "Successfully removed!";
				header("Location: admin.php?success=$success");
	            exit;
			 }else {
			 	$error = "Error Occurred!";
			    header("Location: admin.php?error=$error");
                exit;
			 }
		}
	}
    }
    else {
      header("Location: admin.php");
      exit;
	}
