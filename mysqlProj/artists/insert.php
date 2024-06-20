<?php
// import db info
include "../env.php";

// get data form request
$nameIn = $_POST['name'];
$emailIn = $_POST['email'];
$passwordIn = $_POST['password'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// insert new artist
$query = "INSERT INTO Artists (name, email, password)
VALUES (?, ?, ?)";

$query = $conn->prepare($query);

$query->bind_param('sss', $nameIn, $emailIn, $passwordIn);

$result = $query->execute();

if ($result) {
    echo "New artist inserted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
