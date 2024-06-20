<?php
// import db info
include "../env.php";

// get data form request
$idIn = $_POST['id'];
$nameIn = $_POST['name'];
$emailIn = $_POST['email'];
$passwordIn = $_POST['password'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// update artist
$query = "UPDATE Artists
SET
name = ?,
email = ?,
password = ?
WHERE id = ?";

$query = $conn->prepare($query);

$query->bind_param('sssi', $nameIn, $emailIn, $passwordIn, $idIn);

$result = $query->execute();

if ($result) {
    echo "Artist updated successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
