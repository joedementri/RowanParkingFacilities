<?php
$servername = "localhost";
$username = "phpmyadmin";
$password = "Aswe2018*";
$dbname = "webservice";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


?>
