<!DOCTYPE html>
<html>

<head>
    <title>Quản lý sản phẩm</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./admin_style.css">
</head>

<body>
    <style type="text/css">
    .admin-heading-panel {
        background: #f3f1f1;
        height: 60px;
        line-height: 50px;
        color: #fff;
    }

    .content-wrapper {
        background: #f3f1f1;
        padding: 10px 10px;
    }

    #content-wrapper .container {
        padding: 25px 10px;
        float: left;
    }

    .container {
        width: 200px;
        margin: 0 auto;
    }

    .main-content {
        width: 980px;
        margin-right: 20px;
        float: right;
        padding-top: 25px;
    }
    </style>
    <?php
        session_start();
        include '../connect_db.php';
        include '../function.php';
         $user_id = $_SESSION['user_id'];
                                        
        if (isset($_GET['logout'])) {
            unset($user_id);
            session_destroy();
            header('location: ../../Manage Account/login.php');
        }
    ?>
    <div style="background:#f3f1f1" id="admin-heading-panel">
        <div class="header-container">
            <div style="padding-left: 30px;" class="left-panel">
                <img height="50" width="50" src="apple.png">
            </div>
            <div style="padding-right: 20px;" class="right-panel">
                <img height="24" src="../images/home.png" />
                <a style="color:black" href="../../home.php">Trang chủ</a>
                <img height="24" src="../images/logout.png" />
                <a style="color:black" href="../../home.php?logout=<?php echo $user_id; ?>">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div id="content-wrapper">
        <div class="container">
            <div class="left-menu">
                <div class="menu-heading">Admin Menu</div>
                <div class="menu-items">
                    <ul>
                        <li><a href="product_listing.php">Sản phẩm</a></li>
                        <li><a href="#">Đơn hàng</a></li>
                    </ul>
                </div>
            </div>