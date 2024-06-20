<?php
// import db info
include "../env.php";

// get data from request
$titleIn = $_POST['title'];
$creation_dateIn = date('Y-m-d');
$u_idIn = $_POST['u_id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// insert new playlist
$query = "INSERT INTO Playlists (title, creation_date, u_id)
VALUES (?, ?, ?)";

$query = $conn->prepare($query);

$query->bind_param('ssi', $titleIn, $creation_dateIn, $u_idIn);

$result = $query->execute();

if ($result) {
    echo "New playlist inserted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();