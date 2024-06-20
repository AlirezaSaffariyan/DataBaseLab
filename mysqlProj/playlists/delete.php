<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// import db info
include "../env.php";

// get data from request
$idIn = $_POST['id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// delete playlist
$query = "DELETE FROM Playlists
WHERE id = ?";

$query = $conn->prepare($query);

$query->bind_param('i', $idIn);

$result = $query->execute();

if ($result) {
    echo "Playlist deleted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();