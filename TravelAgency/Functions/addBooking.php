<?php
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $destination = $_POST['destination']; 
    $numberOfAdults = $_POST['numberOfAdults'];
    $numberOfChildren = isset($_POST['numberOfChildren']) ? $_POST['numberOfChildren'] : 0;
    $numberOfInfants = isset($_POST['numberOfInfants']) ? $_POST['numberOfInfants'] : 0;
    $userID = $_SESSION['user_id']; 
    $bookingDate = date("Y-m-d");

if (empty($fullName) || empty($email) || empty($phoneNumber) || empty($destination) || empty($numberOfAdults)) {
    die("All fields are required.");
}

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

    $destinationIDQuery = $conn->prepare("SELECT destinationID FROM destinations WHERE destinationName = ?");
    $destinationIDQuery->bind_param("s", $destination);
    $destinationIDQuery->execute();
    $destinationIDResult = $destinationIDQuery->get_result();

    if ($destinationIDResult->num_rows > 0) {
        $destinationIDRow = $destinationIDResult->fetch_assoc();
        $destinationID = $destinationIDRow['destinationID'];

        $stmt = $conn->prepare("INSERT INTO bookings (destinationID, userID, bookingDate) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $destinationID, $userID, $bookingDate);

        if ($stmt->execute()) {
            echo "Booking added successfully!";
            header("Location: ../Views/home.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Destination not found.";
    }

    $destinationIDQuery->close();
}

$conn->close();