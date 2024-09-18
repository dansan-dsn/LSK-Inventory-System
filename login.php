<?php
session_start();
include './db_connection.php';

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
//     $email = $_POST['login'];
//     $password = $_POST['password'];

//     $query = 'SELECT * FROM users WHERE'
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <img src="./assets/img/lsk_logo.jpg" alt="Logo">
        </div>
        <form>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text" class="form-control" placeholder="Email">
            </div>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" class="form-control" placeholder="Password">
            </div>


            <button type="submit" class="btn login-btn">
                LOG IN NOW <i class="fas fa-arrow-right"></i>
            </button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>