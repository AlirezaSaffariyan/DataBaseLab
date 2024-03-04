<?php
include 'env.php';

// 1. connect to db
$dbc = new mysqli($servername, $username, $password);
$dbc -> select_db($databse);

// check connection
if ($dbc -> connect_error) {
    die("Connection failed: " . $dbc -> connect_error);
}
var_dump($_GET['id']);

// 2. execute query
$sql = "DELETE FROM test WHERE id = 3";
$result = $dbc -> query($sql);

if ($result) {
    echo "query executed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $dbc -> error;
}

// 3. close connection
$dbc -> close();
?>
