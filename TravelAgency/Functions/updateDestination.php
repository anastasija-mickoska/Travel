<?php
include '../config/db_connect.php';
include 'fileUpload_function.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_GET['name']; 
    $destinationName = $_POST['destinationName'];
    $categoryID = $_POST['categoryID'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];

    $imgUrl = upload_file();

    $sql = "UPDATE destinations SET 
                destinationName = :destinationName, 
                categoryID = :categoryID, 
                fromDate = :fromDate, 
                toDate = :toDate, 
                description = :description, 
                price = :price, 
                location = :location";
    
    if ($imgUrl !== false) {
        $sql .= ", imgUrl = :imgUrl";
    }
    
    $sql .= " WHERE destinationName = :name";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':destinationName', $destinationName, PDO::PARAM_STR);
    $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
    $stmt->bindParam(':fromDate', $fromDate, PDO::PARAM_STR);
    $stmt->bindParam(':toDate', $toDate, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $stmt->bindParam(':location', $location, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);

    if ($imgUrl !== false) {
        $stmt->bindParam(':imgUrl', $imgUrl, PDO::PARAM_STR);
    }

    if ($stmt->execute()) {
        echo "Destination updated successfully.";
    } else {
        echo "Error updating destination.";
    }
}
