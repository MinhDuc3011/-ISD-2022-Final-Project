<?php

include './components/connect.php';

session_start();

// Kiem tra gia tri --> boolean
if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($con_db, $_POST['email']);
   $password = mysqli_real_escape_string($con_db, md5($_POST['password'])); // mã hóa password
   


   // Truy vấn database
   $use = mysqli_query($con_db, "USE `manage_account`");

   $select = mysqli_query($con_db, "SELECT * FROM `user_information` WHERE email = '$email' AND password = '$password'") or die('query failed');
   
   $row = mysqli_fetch_assoc($select);

   if (mysqli_num_rows($select) > 0) {
       if ($row['user_type']  == 'admin') {
           $_SESSION['user_id'] = $row['id'];
           $_SESSION['loggedin'] = true;
           header("location: ../Product/admin/addProduct.php");
       } else {
           
           $_SESSION['user_id'] = $row['id'];
           $_SESSION['loggedin'] = true;
           header("location: home.php");

       }
       

   }  else {
       $message[] = "Tài khoản hoặc Mật khẩu không chính xác";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng nhập</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?> 

<section class="form-container">

   <form action="" method="post">
      <h3>Đăng nhập</h3>
      <input type="email" name="email" required placeholder="Email" maxlength="50"  class="box">
      <input type="password" name="password" required placeholder="Mật khẩu" maxlength="20"  class="box">
      <input type="submit" value="Đăng nhập" class="btn" name="submit">
      <p> <a href="forgot_password.php" class="forgot-password">Quên mật khẩu?<a></p>
      <a href="user_register.php" class="option-btn-1">Đăng ký ngay</a>
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>