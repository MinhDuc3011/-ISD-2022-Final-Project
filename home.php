<?php

include './components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vua Táo - Điện thoại, Phụ kiện chính hãng</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include './components/user_header.php'; ?>

    <div class="home-bg">

        <section class="home">

            <div class="swiper home-slider">

                <div class="swiper-wrapper">

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="images/home-img-1.png" alt="">
                        </div>
                        <div class="content">
                            <span>Giảm đến 50%</span>
                            <h3>Oppo Reno 7</h3>
                            <a href="#" class="btn">Mua ngay</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="images/home-img-2.png" alt="">
                        </div>
                        <div class="content">
                            <span>Giảm đến 50%</span>
                            <h3>Đồng hồ G-Shock</h3>
                            <a href="#" class="btn">Mua ngay</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="images/home-img-3.png" alt="">
                        </div>
                        <div class="content">
                            <span>Giảm đến 50%<< /span>
                                    <h3>Tai nghe Sony chính hãng</h3>
                                    <a href="#" class="btn">Mua ngay</a>
                        </div>
                    </div>

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </section>

    </div>


    <section class="home-products">

        <h1 class="heading">Sản phẩm mới nhất</h1>

        <div class="swiper products-slider">

            <div class="swiper-wrapper">

                <?php
                include './Product/function.php';
                include './components/function_cart.php';
                $use = mysqli_query($con, "USE `test`");
                $select = mysqli_query($con, "SELECT * FROM `product` Limit 6") or die('query failed');

                if (mysqli_num_rows($select) > 0) {
                    $fetch = mysqli_fetch_assoc($select);

                ?>
                    <form action="" method="post" class="swiper-slide slide">
                        <input type="hidden" name="pid" value="<?= $fetch['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch['image']; ?>">
                        <img src="./Product/<?= $fetch['image']; ?>" alt="">

                        <div class="name"><?= $fetch['name']; ?></div>
                        <div class="flex">
                            <div class="price"><?= $fetch['price']; ?> <span>VND</span></div>
                            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                        </div>
                        <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">
                    </form>
                <?php

                } else {
                    echo '<p class="empty">Không có sản phẩm mới nào</p>';
                }
                ?>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>


    <?php include './components/footer.php'; ?>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>

    <script>
        var swiper = new Swiper(".home-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });


        var swiper = new Swiper(".products-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                550: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

</body>

</html>