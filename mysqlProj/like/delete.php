<?php
// import db info
include "../env.php";

// get data from request
$u_idIn = $_POST['u_id'];
$s_idIn = $_POST['s_id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// delete like
$query = "DELETE FROM `Like`
WHERE u_id = ? AND s_id = ?";

$query = $conn->prepare($query);

$query->bind_param('ii', $u_idIn, $s_idIn);

$result = $query->execute();

if ($result) {
    echo "Like deleted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();