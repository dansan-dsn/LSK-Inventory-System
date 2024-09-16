<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lsk_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
    die("Error occurred: ". $conn->connect_error);
}
    // echo "Connected successfully";
?>