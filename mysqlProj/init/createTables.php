<?php
// import db info
include "../env.php";

// open db connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo 'Connected successfully<br>
Initializing tables...<br>';

// function for checking result of table creation
function checkRes($result) {
    global $tableName, $conn;
    if ($result) {
        echo "Table \"{$tableName}\" has been created successfully!";
    } else {
        "Error creating table \"{$tableName}\":<br>" . $conn->error;
    }
    echo "<br>";
}

// Artists
$tableName = 'Artists';

$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(32) NOT NULL,
  password VARCHAR(128) NOT NULL,
  email VARCHAR(254) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (email)
)";

$result = $conn->query($query);

checkRes($result);

// Users
$tableName = 'Users';

$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(32) NOT NULL,
  email VARCHAR(254) NOT NULL,
  password VARCHAR(128) NOT NULL,
  register_date DATE NOT NULL,
  birth_date DATE NOT NULL,
  region VARCHAR(90) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (username),
  UNIQUE (email)
)";

$result = $conn->query($query);

checkRes($result);

// Playlist
$tableName = 'Playlists';

$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  creation_date DATE NOT NULL,
  u_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (u_id) REFERENCES Users (id)
)";

$result = $conn->query($query);

checkRes($result);

// Follow
$tableName = 'Follow';

$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  u_id INT NOT NULL,
  a_id INT NOT NULL,
  PRIMARY KEY (u_id, a_id),
  FOREIGN KEY (u_id) REFERENCES Users (id),
  FOREIGN KEY (a_id) REFERENCES Artists (id)
)";

$result = $conn->query($query);

checkRes($result);

// Albums
$tableName = 'Albums';

$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  release_date DATE NOT NULL,
  genre VARCHAR(32) NOT NULL,
  artist_id INT NOT NULL,
  discs INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (artist_id) REFERENCES Artists (id)
)";

$result = $conn->query($query);

checkRes($result);

// Songs
$tableName = 'Songs';

$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  duration INT NOT NULL,
  album_id INT NOT NULL,
  track_number INT NOT NULL,
  disc_number INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (album_id) REFERENCES Albums (id)
)";

$result = $conn->query($query);

checkRes($result);

// Stream
$tableName = 'Stream';

$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  times_played INT NOT NULL,
  u_id INT NOT NULL,
  s_id INT NOT NULL,
  PRIMARY KEY (u_id, s_id),
  FOREIGN KEY (u_id) REFERENCES Users (id),
  FOREIGN KEY (s_id) REFERENCES Songs (id)
)";

$result = $conn->query($query);

checkRes($result);

// Like
$tableName = 'Like';

$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  u_id INT NOT NULL,
  s_id INT NOT NULL,
  PRIMARY KEY (u_id, s_id),
  FOREIGN KEY (u_id) REFERENCES Users (id),
  FOREIGN KEY (s_id) REFERENCES Songs (id)
)";

$result = $conn->query($query);

checkRes($result);

// Playlist_songs
$tableName = 'Playlist_songs';
// TODO create added_date_time
$query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
  p_id INT NOT NULL,
  s_id INT NOT NULL,
  PRIMARY KEY (p_id, s_id),
  FOREIGN KEY (p_id) REFERENCES Playlists(id),
  FOREIGN KEY (s_id) REFERENCES Songs(id)
)";

$result = $conn->query($query);

checkRes($result);

// close db connection
$conn->close();