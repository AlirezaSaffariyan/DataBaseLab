<?php
// import db info
include "../env.php";

// get data from request
$u_idIn = $_POST['u_id'];
$s_idIn = $_POST['s_id'];
$times_playedIn = $_POST['times_played'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// update stream
$query = "UPDATE Stream
SET
u_id = ?,
s_id = ?,
times_played = ?
WHERE u_id = ? AND s_id = ?";

$query = $conn->prepare($query);

$query->bind_param('iiiii', $u_idIn, $s_idIn, $times_playedIn, $u_idIn, $s_idIn, );

$result = $query->execute();

if ($result) {
    echo "Stream updated successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
?>