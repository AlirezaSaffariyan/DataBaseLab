<?php
// import db info
include "env.php";
// import table printer
require __DIR__ . '/printTable.php';

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableName = ucfirst(strtolower($_GET['name']));

$query = "SELECT * FROM `{$tableName}`";

$result = $conn->query($query);

printTable($result, $tableName);

// close db connection
$conn->close();