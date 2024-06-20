<?php
// import db info
include "../env.php";

// get data from request
$idIn = $_POST['id'];
$titleIn = $_POST['title'];
$durationIn = $_POST['duration'];
$album_idIn = $_POST['album_id'];
$track_numberIn = $_POST['track_number'];
$disc_numberIn = $_POST['disc_number'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// update song
$query = "UPDATE Songs
SET
title = ?,
duration = ?,
album_id = ?,
track_number = ?,
disc_number = ?
WHERE id = ?";

$query = $conn->prepare($query);

$query->bind_param('sdiiii', $titleIn, $durationIn, $album_idIn, $track_numberIn, $disc_numberIn, $idIn);

$result = $query->execute();

if ($result) {
    echo "Song updated successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
