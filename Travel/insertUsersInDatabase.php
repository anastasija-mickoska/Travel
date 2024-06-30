<?php
$users = [
    ['dolores@gmail.com', 'dolores123', 'Dolores', 'Medina'],
    ['liam_s@gmail.com', 'liamS1234!', 'Liam', 'Stephens'],
    ['theodore_adams@yahoo.com', 'theo0000!', 'Theodore', 'Adams'],
    ['kaya@outlook.com', 'kaya1234', 'Kaya', 'Miller']
];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_agency";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO users (emailAddress, password, firstName, lastName) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $emailAddress, $hashedPassword, $firstName, $lastName);

foreach ($users as $user) {
    $emailAddress = $user[0];
    $hashedPassword = password_hash($user[1], PASSWORD_DEFAULT);
    $firstName = $user[2];
    $lastName = $user[3];
    $stmt->execute();
}

echo "Users added successfully.";

$stmt->close();
$conn->close();
