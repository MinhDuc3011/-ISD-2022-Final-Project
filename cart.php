<?php

include 'components/connect.php';
include './Product/function.php';

session_start();
$use = mysqli_query($con, "USE `test`");


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};


if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = mysqli_query($con, "DELETE FROM `cart` WHERE id = '$cart_id'") or die('query failed');
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = mysqli_query($con, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $update_qty = mysqli_query($con, "UPDATE `cart` SET quantity = '$qty' WHERE id = '$cart_id'");
   $message[] = 'Giỏ hàng được cập nhật';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giỏ  hàng</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products shopping-cart">

   <h3 class="heading">Giỏ hàng</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $use = mysqli_query($con, "USE `test`");   
      $select = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
      if (mysqli_num_rows($select) > 0) {
         $fetch = mysqli_fetch_assoc($select);
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="cart_id" value="<?= $fetch['id']; ?>">
      <img src="./Product/<?= $fetch['image']; ?>" alt="">
      <div class="name"><?= $fetch['name']; ?></div>
      <div class="flex">
         <div class="price"><?= $fetch['price']; ?> VND</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch['quantity']; ?>">
         <button type="submit" class="fas fa-edit" name="update_qty"></button>
      </div>
      <div class="sub-total"> Tổng cộng: <span><?= $sub_total = ($fetch['price'] * $fetch['quantity']); ?> VND</span> </div>
      <input type="submit" value="Xóa sản phẩm" onclick="return confirm('Bạn muốn xóa sản phẩm khỏi giỏ hàng?');" class="delete-btn" name="delete">
   </form>
   <?php
   $grand_total += $sub_total;
      
   }else{
      echo '<p class="empty">Giỏ hàng của bạn trống</p>';
   }

   ?>
   </div>

   <div class="cart-total">
      <p>Tổng cộng : <span><?= $grand_total; ?> VND</span></p>
      <a href="home.php" class="option-btn-1">Tiếp tục mua sắm</a>
      <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Bạn muốn xóa hết sản phẩm trong giỏ hàng chứ?');">Xóa tất cả sản phầm</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Thanh toán</a>
   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>