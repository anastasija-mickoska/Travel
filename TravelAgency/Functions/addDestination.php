<?php
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
$destinationName = $_POST['destinationName'];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];
$description = $_POST['description'];
$price = $_POST['price'];
$location = $_POST['location'];
$imgUrl = $_POST['imgUrl'];
$categoryID=$_GET['id'];

// Validate input data (for example, you can add more validation as per your requirements)
if (empty($destinationName) || empty($fromDate) || empty($toDate) || empty($description) || empty($price) || empty($location) || empty($imgUrl)) {
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
$stmt = $conn->prepare("INSERT INTO destinations (categoryID, destinationName, fromDate, toDate, description, price, location, imgUrl)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssss", $categoryID, $destinationName, $fromDate, $toDate, $description, $price, $location, $imgUrl);

if ($stmt->execute()) {
    echo "Destination added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();

}else{
    header("Location: ../Views/login.php");
    exit;
  }