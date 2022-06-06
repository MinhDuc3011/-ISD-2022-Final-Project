<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

    <section class="flex">

        <a href="home.php" class="logo">Vua Táo Store<span>.</span></a>

        <ul class="navbar">

            <li>
                <a href="#">Mobile</a>

                <ul class="subnav">
                    <li><a href="../admin/iphone.php">Iphone</a></li>
                    <li><a href="../admin/iphone.php">Samsung</a></li>
                    <li><a href="../admin/iphone.php">Oppo</a></li>
                </ul>
            </li>
            <li>
               <a href="#">Tablet</a>

               <ul class="subnav">
                    <li><a href="#">Iphone</a></li>
                    <li><a href="#">Samsung</a></li>
                    <li><a href="#">Oppo</a></li>
                </ul>
            </li>
            <li>
               <a href="#">Phụ kiện</a>

               <ul class="subnav">
                    <li><a href="#">Dây sạc</a></li>
                    <li><a href="#">Ốp</a></li>
                    <li><a href="#">Tai nghe</a></li>
                </ul>
            </li>
        </ul>

        <div class="icons">

            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="#"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php          
             include 'connect.php';
             $use = mysqli_query($con_db, "USE `manage_account`");
             if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                $user_id = $_SESSION['user_id'];
                $use = mysqli_query($con_db, "USE `manage_account`");
                $select = mysqli_query($con_db, "SELECT * FROM `user_information` WHERE id = '$user_id'") or die('query failed');
                if (mysqli_num_rows($select) > 0) {
                    $fetch = mysqli_fetch_assoc($select);
                }
         ?>
            <p><?= $fetch['name']; ?></p>
            <a href="update_user.php" class="btn">Cập nhật thông tin</a>

            <?php 
            include 'connect.php';
            $user_id = $_SESSION['user_id'];
                                        
            if (isset($_GET['logout'])) {
                unset($user_id);
                session_destroy();
                header('location: home.php');
            }
            ?>
            <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">Đăng xuất</a>
            <?php
            }else{     
         ?>
            <div class="flex-btn">
                <a href="user_login.php" class="option-btn">Đăng nhập</a>
                <a href="user_register.php" class="option-btn">Đăng ký</a>
            </div>
            <?php
            }
         ?>


        </div>

    </section>

</header>