<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    // Validate and sanitize input data
    $destinationID = $_POST['destinationID'];
    $categoryID = $_POST['categoryID'];
    $destinationName = $_POST['destinationName'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $imgUrl = $_POST['imgUrl'];

    // Validate input data
    if (empty($destinationID) || empty($categoryID) || empty($destinationName) || empty($fromDate) || empty($toDate) || empty($description) || empty($price) || empty($location) || empty($imgUrl)) {
        die("All fields are required.");
    }

    // Database connection details
    $servername = "localhost"; // Replace with your server name
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "travel_agency"; // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("UPDATE destinations SET categoryID = ?, destinationName = ?, fromDate = ?, toDate = ?, description = ?, price = ?, location = ?, imgUrl = ? WHERE destinationID = ?");
    $stmt->bind_param("issssdssi", $categoryID, $destinationName, $fromDate, $toDate, $description, $price, $location, $imgUrl, $destinationID);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Destination updated successfully.";
        // Redirect to a confirmation page or another page
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
} else {
    header("Location: login.php");
    exit;
}
