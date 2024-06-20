<?php
// import db info
include "../env.php";

// get data from request
$idIn = $_POST['id'];
$usernameIn = $_POST['username'];
$emailIn = $_POST['email'];
$passwordIn = $_POST['password'];
$birth_dateIn = $_POST['birth_date'];
$regionIn = $_POST['region'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// update user
$query = "UPDATE Users
SET
username = ?,
email = ?,
password = ?,
birth_date = ?,
region = ?
WHERE id = ?";

$query = $conn->prepare($query);

$query->bind_param('sssssi', $usernameIn, $emailIn, $passwordIn, $birth_dateIn, $regionIn, $idIn);

$result = $query->execute();

if ($result) {
    echo "User updated successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
