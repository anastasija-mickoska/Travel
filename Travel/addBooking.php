<?php
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
// Validate and sanitize input data
$fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $destination = $_POST['destination']; // Assuming you already have the destinationID from the destinationName
    $numberOfAdults = $_POST['numberOfAdults'];
    $numberOfChildren = isset($_POST['numberOfChildren']) ? $_POST['numberOfChildren'] : 0;
    $numberOfInfants = isset($_POST['numberOfInfants']) ? $_POST['numberOfInfants'] : 0;
    $userID = $_SESSION['user_id']; // Assuming user is logged in and their ID is stored in session
    $bookingDate = date("Y-m-d");

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

// Check if form is submitted


    // Get the destinationID from the destination name
    $destinationIDQuery = $conn->prepare("SELECT destinationID FROM destinations WHERE destinationName = ?");
    $destinationIDQuery->bind_param("s", $destination);
    $destinationIDQuery->execute();
    $destinationIDResult = $destinationIDQuery->get_result();

    if ($destinationIDResult->num_rows > 0) {
        $destinationIDRow = $destinationIDResult->fetch_assoc();
        $destinationID = $destinationIDRow['destinationID'];

        // Insert booking data into bookings table
        $stmt = $conn->prepare("INSERT INTO bookings (destinationID, userID, bookingDate) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $destinationID, $userID, $bookingDate);

        if ($stmt->execute()) {
            echo "Booking added successfully!";
            // Redirect to a confirmation page or another page
            header("Location: confirmation.php");
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
?>
