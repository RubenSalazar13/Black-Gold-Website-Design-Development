<?php
//Connecting to Database
$servername = "localhost";
$username = "root"; //edit if you have set a username for MySQL
$password = ""; // edit if you have set a password
$dbname = "blackoil";

// Create connection syntax
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>