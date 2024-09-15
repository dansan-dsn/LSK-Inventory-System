<?php
    include './root/process.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>LSK Inventory - mgt dashboard</title>
    <link rel="shortcut icon" href="../assets/images/_imgs/logo.png" type="image/x-icon">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">
    <link rel="stylesheet" href="assets/css/header.products.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        a {
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="index" class="logo">
                    <img src="./assets/img/lsk_logo.jpg" alt="LSK-logo" class="img-fluid" style="max-height: 30px;"/>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <?php $current_page = basename($_SERVER['PHP_SELF']);?>
                <div class="container-fluid">
                    <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                        <div class="input-group">
                            <input type="text" placeholder="Search your product" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-search search-icon"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='bx bx-message-alt-check'></i>
                            </a>
                            <div class="dropdown-menu mt-1" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-bell"></i>
                                <span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    New user registered
                                                </span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Rahmad commented on Admin
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="assets/img/profile.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Reza send messages to you
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Farrah liked Admin
                                                </span>
                                                <span class="time">17 minutes ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="profile-pic">
                                <div class="profile_rad d-flex align-items-center justify-content-center">
                                    <img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle profile_cursor">
                                    <span><i class='bx bx-cog profile_cursor bg-dark text-white p-1 rounded-circle'></i></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper ">
                <ul class="nav scrollable-sidebar">
                    <li class="nav-item <?= ($current_page == 'index.php') ? 'active' : '' ?>">
                        <a href="<?=SITE_URL?>/admin-dash">
                            <i class="la la la-table"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="">
            <p class="d-inline-flex nav-item" style="padding-bottom: -2rem;">
                <a  type="button" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class='bx bx-accessibility'></i>
                    <span>Receiving</span>
                    <i class="la la-angle-down" style="padding-left: 2.5rem; font-size: 1rem;"></i>
                </a>
            </p>
            <div class="collapse sub-category" id="collapseExample">
                <ul class="list-unstyled" id="">
                    <li class="nav-item sub-folder <?= ($current_page == "new-products.php") ? 'active' : '' ?>" >
                        <a href="new-products.php">
                            <i class="la la-cart-plus"></i>
                            <p class="sub-folder">Products Recieved</p>
                        </a>
                    </li>
                    <li class="nav-item sub-folder <?= ($current_page == "stock.php") ? 'active' : ''?>">
                        <a href="./stock.php">
                        <i class="la la-archive"></i>
                            <p class="sub-folder">Stock Levels</p>
                        </a>
                    </li>
                    <li class="nav-item sub-folder <?= ($current_page == "categories.php") ? 'active' : '' ?>">
                        <a href="categories.php">
                            <i class="la la-list"></i>
                            <p class="sub-folder">Report Analytics</p>
                        </a>
                    </li>
                    <li class="nav-item sub-folder <?= ($current_page == "delivery_records.php") ? 'active' : '' ?>">
                        <a href="delivery_records.php">
                            <i class="la la-truck"></i>
                            <p class="sub-folder">Product Categories</p>
                        </a>
                    </li>
                    <li class="nav-item sub-folder <?= ($current_page == "delivery_records.php") ? 'active' : '' ?>">
                        <a href="delivery_records.php">
                            <i class="la la-truck"></i>
                            <p class="sub-folder">Delivery Records</p>
                        </a>
                    </li>
                    <li class="nav-item sub-folder <?= ($current_page == "footere.php") ? 'active' : '' ?>" style="font-family: cursive;">
                        <a href="footere.php">
                            <i class="la la-truck"></i>
                            <p class="sub-folder">Suppliers</p>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
                    <li class="nav-item">
                        <a href="icons">
                        <i class='bx bxs-user-account'></i>
                            <p>Staff Management</p>
                        </a>
                    </li>
                    <li class="nav-item update-pro btn btn-danger">
                        <a class="text-white" href="icons">
                            <i class="la la-power-off"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>