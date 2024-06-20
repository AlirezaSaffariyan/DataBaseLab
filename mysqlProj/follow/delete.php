<?php
// import db info
include "../env.php";

// get data from request
$u_idIn = $_POST['u_id'];
$a_idIn = $_POST['a_id'];

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// delete follow
$query = "DELETE FROM Follow
WHERE u_id = ? AND a_id = ?";

$query = $conn->prepare($query);

$query->bind_param('ii', $u_idIn, $a_idIn);

$result = $query->execute();

if ($result) {
    echo "Follow deleted successfully!";
} else {
    echo "Error:<br>" . $conn->error;
}

// close db connection
$conn->close();
