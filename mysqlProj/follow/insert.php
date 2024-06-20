<?php
// import db info
include "../env.php";

// get data from request
$u_idIn = $_POST['u_id'];
$a_idIn = $_POST['a_id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// insert new follow
$query = "INSERT INTO Follow (u_id, a_id)
VALUES (?, ?)";

$query = $conn->prepare($query);

$query->bind_param('ii', $u_idIn, $a_idIn);

$result = $query->execute();

if ($result) {
    echo "New follow inserted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
