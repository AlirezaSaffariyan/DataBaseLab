<?php
// import db info
include "../env.php";

// get data from request
$idIn = $_POST['id'];
$titleIn = $_POST['title'];
$u_idIn = $_POST['u_id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// update playlist
$query = "UPDATE Playlists
SET
title = ?,
u_id = ?
WHERE id = ?";

$query = $conn->prepare($query);

$query->bind_param('sii', $titleIn, $u_idIn, $idIn);

$result = $query->execute();

if ($result) {
    echo "Playlist updated successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();