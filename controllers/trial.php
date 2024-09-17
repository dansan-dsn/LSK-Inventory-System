<?php 
session_start();
include './db_connection.php';

$name = $email = '';
$update = false;

if(isset($_POST['save'])){
    // calll the body
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "Insert into trial (name,email) values ('$name', '$email')";

    // set the query parameters
    mysqli_query($conn, $sql);
    $_SESSION['message'] = "Address saved";
    header('location: ../trial.php');
}
?>