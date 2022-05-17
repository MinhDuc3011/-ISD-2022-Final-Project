
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="../css/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <script src="JS/jquery-3.5.1.min.js"></script>
    <script src="JS/multislider.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>WEB ĐIỆN THOẠI</title>
</head>

<!--Navbar-->
<style>
.navbar-top {
    width: 100px;
    float: left;
}

.product-items {
    overflow: hidden;
    margin-bottom: 10px;
    padding: 15px;
    margin-top: 160px;
}

.product-item {
    float: left;
    margin: 1%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    line-height: 26px;
}

.product-item label {
    font-weight: bold;
}

.product-item p {
    margin: 0;
    line-height: 26px;
    max-height: 52px;
    overflow: hidden;
}

.product-price {
    color: red;
    font-weight: bold;
}

.product-img {
    padding: 5px;
    border: 1px solid #ccc;
    margin-bottom: 5px;
    max-width: 100%;
    max-height: 100%;
    display: block;
    width: 150px;
    height: 150px
}

.product-item img {
    max-width: 100%;
}

.product-item ul {
    margin: 0;
    padding: 0;
    border-right: 1px solid #ccc;
}

.product-item ul li {
    float: left;
    width: 33.3333%;
    list-style: none;
    text-align: center;
    border: 1px solid #ccc;
    border-right: 0;
    box-sizing: border-box;
}
</style>

<body>
    <nav>
        <!--Navbar has two part the top one and the bottom one-->
        <!--Here is top one and in this part I put logo, my account part, and the shopping cart-->
        <div class="navbar-top">
            <div>
                <button id="menuButton"><i class="fas fa-bars"></i></button>
                <!--Logo-->
                <a href="index.php" id="logo">
                    <img src="apple.png" alt="">

                </a>
            </div>
            <div>
                <!--My account part-->
                <div class="account">
                    <a href="">
                        <!-- <button class="account-btn">
                            <i class="fas fa-user-alt"></i>
                        </button> -->

                        <li class="header__navbar-item header__navbar-user">

                            <span class="account-text">
                                <?php 
                                    include '../connect_db.php';
                                    session_start();                                                       
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                        $user_id = $_SESSION['user_id'];
                                        $use = mysqli_query($con, "USE `test`");
                                        $select = mysqli_query($con, "SELECT * FROM `user_information` WHERE id = '$user_id'") or die('query failed');
                                        if (mysqli_num_rows($select) > 0) {
                                            $fetch = mysqli_fetch_assoc($select);
                                        }
                                        echo "Hi, " .$fetch['name'];
                                    } else {
                                        echo "<a href='login.php' class='account-text-login' style=''>Đăng nhập</a>";
                                        echo " <style>
                                                .header__navbar-user:hover .header__navbar-user-menu {display: none; }
                                            </style>";                                                                                                       
                                    }
                                ?>
                            </span>
                            <ul class="header__navbar-user-menu">
                                <li class="header__navbar-user-item">
                                    <a href="update_profile.php" class="">Cập nhật thông tin</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <?php 
                                        include '../connect_db.php';
                                        $user_id = $_SESSION['user_id'];
                                        
                                        if (isset($_GET['logout'])) {
                                            unset($user_id);
                                            session_destroy();
                                            header('location: login.php');
                                        }
                                    ?>
                                    <a href="index.php?logout=<?php echo $user_id; ?>" class="">Đăng xuất</a>

                                </li>
                            </ul>
                        </li>
                    </a>
                    <!--When we click the btnShowAccountInfo this section will be displayed-->
                </div>
                <!--Shopping cart-->
                <div class="shopping-cart">
                    <div class="sum-prices">
                        <!--Shopping cart logo-->
                        <i class="fas fa-shopping-cart shoppingCartButton"></i>
                        <!--The total prices of products in the shopping cart -->
                        <h6 id="sum-prices"></h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar bottom part -->
        <!-- Here I put the links to the other pages or nav links -->
        <div class="navbar" id="navbar">
            <ul class="links">
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Samsung</strong></a>
                </li>
                <li class="nav-links">
                    <a href="xiaomi.php" class="link"><strong>Xiaomi</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Oppo</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Nokia</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Iphone</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobile.html" class="link"><strong>Vivo</strong></a>
                </li>
                <li class="nav-links">
                    <a herf="mobile.html" class="link"><strong>ASUS</strong></a>
                </li>
                <li class="nav-links">
                    <a herf="mobile.html" class="link"><strong>Realme</strong></a>
                </li>
            </ul>

            <!-- The searchbar which will be in the right side of the links -->
            <div class="searchbar">
                <form action="#">
                    <input type="search" placeholder="Bạn muốn tìm kiếm sản phẩm nào" />
                    <i class="fa fa-search" id="search-icon"></i>
                </form>
            </div>
        </div>
        <div class="producstOnCart hide">
            <div class="overlay"></div>
            <div class="top">
                <button id="closeButton">
                    <i class="fas fa-times-circle"></i>
                </button>
                <h3>Giỏ hàng</h3>
            </div>
            <ul id="buyItems">
                <h4 class="empty">Giỏ hàng của bạn đang trống</h4>
            </ul>
            <button class="btn checkout hidden">Kiểm tra giỏ hàng ngay</button>
        </div>
    </nav>

    <?php
        include '../connect_db.php';  
        include '../function.php';      
        session_start();
        $use = mysqli_query($con, "USE `test`");
        $products = mysqli_query($con, "SELECT * FROM `product` WHERE `brand`= 'xiaomi' ");       
        ?>
    <div class="container">
        <div class="product-items">
            <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
            <div class="product-item">
                <div class="product-img">
                <img src="../<?= $row['image'] ?>" alt="<?= $row['name'] ?>"
                        title="<?= $row['name'] ?>" />
                </div>
                <strong><?= $row['name'] ?></strong><br />
                <label>Giá: </label><span class="product-price"><?= number_format($row['price'], 0, ",", ".") ?>
                    đ</span><br />
                <div class="buy-button">
                    <a href="./add_cart.php">Mua sản phẩm</a>
                </div>
            </div>
            <?php } ?>
            <div class="clear-both"></div>

            <div class="clear-both"></div>
        </div>
    </div>
</body>

</html>