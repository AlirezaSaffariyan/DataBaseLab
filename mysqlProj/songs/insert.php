<?php
// import db info
include "../env.php";

// get data from request
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

// insert new song
$query = "INSERT INTO Songs (title, duration, album_id, track_number, disc_number)
VALUES (?, ?, ?, ?, ?)";

$query = $conn->prepare($query);

$query->bind_param('sdiii', $titleIn, $durationIn, $album_idIn, $track_numberIn, $disc_numberIn);

$result = $query->execute();

if ($result) {
    echo "New song inserted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
