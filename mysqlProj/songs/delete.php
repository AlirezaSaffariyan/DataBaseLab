<?php
// import db info
include "../env.php";

// get data from request
$idIn = $_POST['id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// delete song
$query = "DELETE FROM Songs
WHERE id = ?";

$query = $conn->prepare($query);

$query->bind_param('i', $idIn);

$result = $query->execute();

if ($result) {
    echo "Song deleted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
