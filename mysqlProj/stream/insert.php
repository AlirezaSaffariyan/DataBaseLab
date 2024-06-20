<?php
// import db info
include "../env.php";

// get data from request
$u_idIn = $_POST['u_id'];
$s_idIn = $_POST['s_id'];
$times_playedIn = 1;

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// insert new stream
$query = "INSERT INTO Stream (u_id, s_id, times_played)
VALUES (?, ?, ?)";

$query = $conn->prepare($query);

$query->bind_param('iii', $u_idIn, $s_idIn, $times_playedIn);

$result = $query->execute();

if ($result) {
    echo "New stream inserted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
