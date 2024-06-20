<?php
// import db info
include "../env.php";

// open db connection
$conn = new mysqli($hostname, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo 'Connected successfully<br>
Creating database...<br>';

// create db
$query = "CREATE DATABASE {$dbname}";

$result = $conn->query($query);

if ($result) {
    echo "Database {$dbname} has been created successfully!";
} else {
    echo "Error creating database {$dbname}:<br>" . $conn->error;
}

// close db connection
$conn->close();
