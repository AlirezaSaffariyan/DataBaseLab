<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// import db info
include "../env.php";

// get data from request
$idIn = $_POST['id'];
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

// update album
$query = "UPDATE Albums
SET
title = ?,
release_date = ?,
genre = ?,
artist_id = ?,
discs = ?
WHERE id = ?";

$query = $conn->prepare($query);

$query->bind_param('sssiii', $titleIn, $release_dateIn, $genreIn, $artist_idIn, $discsIn, $idIn);

$result = $query->execute();

if ($result) {
    echo "Album updated successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
