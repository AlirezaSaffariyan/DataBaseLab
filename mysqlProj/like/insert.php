<?php
// import db info
include "../env.php";

// get data from request
$u_idIn = $_POST['u_id'];
$s_idIn = $_POST['s_id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// insert new like
$query = "INSERT INTO `Like` (u_id, s_id)
VALUES (?, ?)";

$query = $conn->prepare($query);

$query->bind_param('ii', $u_idIn, $s_idIn);

$result = $query->execute();

if ($result) {
    echo "New like inserted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
