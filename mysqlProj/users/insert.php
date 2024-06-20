<?php
// import db info
include "../env.php";

// get data from request
$usernameIn = $_POST['username'];
$emailIn = $_POST['email'];
$passwordIn = $_POST['password'];
$register_dateIn = date('Y-m-d');
$birth_dateIn = $_POST['birth_date'];
$regionIn = $_POST['region'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// insert new user
$query = "INSERT INTO Users (username, email, password, register_date, birth_date, region)
VALUES (?, ?, ?, ?, ?, ?)";

$query = $conn->prepare($query);

$query->bind_param('ssssss', $usernameIn, $emailIn, $passwordIn, $register_dateIn, $birth_dateIn, $regionIn);

$result = $query->execute();

if ($result) {
    echo "New user inserted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
