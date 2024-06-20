<?php
// import db info
include "../env.php";

// get data from request
$titleIn = $_POST['title'];
$release_dateIn = $_POST['release_date'];
$genreIn = $_POST['genre'];
$artist_idIn = $_POST['artist_id'];
$discsIn = $_POST['discs'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// insert new album
$query = "INSERT INTO Albums (title, release_date, genre, artist_id, discs)
VALUES (?, ?, ?, ?, ?)";

$query = $conn->prepare($query);

$query->bind_param('sssii', $titleIn, $release_dateIn, $genreIn, $artist_idIn, $discsIn);

$result = $query->execute();

if ($result) {
    echo "New album inserted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
