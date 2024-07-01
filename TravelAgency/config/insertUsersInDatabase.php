<?php
$admins = [
    ['emailAddress' => 'admin1@travelagency.com', 'password' => 'Admin1123', 'FullName' => 'Admin1'],
    ['emailAddress' => 'admin2@travelagency.com', 'password' => 'Admin2123', 'FullName' => 'Admin2']
];

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

$queryAdmins = "INSERT INTO admins (emailAddress, password, FullName) VALUES (?, ?, ?)";
$stmtAdmins = $conn->prepare($queryAdmins);

foreach ($admins as $admin) {
    $hashedPassword = password_hash($admin['password'], PASSWORD_DEFAULT);
    $stmtAdmins->bind_param("sss", $admin['emailAddress'], $hashedPassword, $admin['FullName']);
    $stmtAdmins->execute();
}

if ($stmtAdmins->affected_rows > 0) {
    echo "Admins added successfully.<br>";
} else {
    echo "No admins were added.<br>";
}

$stmtAdmins->close(); 

$queryUsers = "INSERT INTO users (emailAddress, password, firstName, lastName) VALUES (?, ?, ?, ?)";
$stmtUsers = $conn->prepare($queryUsers);

foreach ($users as $user) {
    $hashedPassword = password_hash($user[1], PASSWORD_DEFAULT); 
    $stmtUsers->bind_param("ssss", $user[0], $hashedPassword, $user[2], $user[3]);
    $stmtUsers->execute();
}

if ($stmtUsers->affected_rows > 0) {
    echo "Users added successfully.<br>";
} else {
    echo "No users were added.<br>";
}

$stmtUsers->close(); 

$conn->close();
