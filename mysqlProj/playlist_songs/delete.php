<?php
// import db info
include "../env.php";

// get data from request
$p_idIn = $_POST['p_id'];
$s_idIn = $_POST['s_id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// delete playlist song
$query = "DELETE FROM Playlist_songs
WHERE p_id = ? AND s_id = ?";

$query = $conn->prepare($query);

$query->bind_param('ii', $p_idIn, $s_idIn);

$result = $query->execute();

if ($result) {
    echo "Playlist song deleted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
