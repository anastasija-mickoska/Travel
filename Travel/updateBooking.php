<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    // Validate and sanitize input data
    $bookingID = $_POST['bookingID'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $destination = $_POST['destination'];
    $numberOfAdults = $_POST['numberOfAdults'];
    $numberOfChildren = isset($_POST['numberOfChildren']) ? $_POST['numberOfChildren'] : 0;
    $numberOfInfants = isset($_POST['numberOfInfants']) ? $_POST['numberOfInfants'] : 0;

    // Validate input data
    if (empty($bookingID) || empty($fullName) || empty($email) || empty($phoneNumber) || empty($destination) || empty($numberOfAdults)) {
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

    // Get the destinationID from the destination name
    $destinationIDQuery = $conn->prepare("SELECT destinationID FROM destinations WHERE destinationName = ?");
    $destinationIDQuery->bind_param("s", $destination);
    $destinationIDQuery->execute();
    $destinationIDResult = $destinationIDQuery->get_result();

    if ($destinationIDResult->num_rows > 0) {
        $destinationIDRow = $destinationIDResult->fetch_assoc();
        $destinationID = $destinationIDRow['destinationID'];

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("UPDATE bookings SET destinationID = ?, fullName = ?, email = ?, phoneNumber = ?, numberOfAdults = ?, numberOfChildren = ?, numberOfInfants = ? WHERE bookingID = ? AND userID = ?");
        $userID = $_SESSION['user_id']; // Assuming user is logged in and their ID is stored in session
        $stmt->bind_param("isssiiii", $destinationID, $fullName, $email, $phoneNumber, $numberOfAdults, $numberOfChildren, $numberOfInfants, $bookingID, $userID);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Booking updated successfully.";
            // Redirect to a confirmation page or another page
            header("Location: confirmation.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Destination not found.";
    }

    // Close the destination ID query
    $destinationIDQuery->close();

    // Close connection
    $conn->close();
} else {
    header("Location: login.php");
    exit;
}
