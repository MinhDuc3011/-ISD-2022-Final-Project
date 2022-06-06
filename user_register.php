<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

// Kiem tra gia tri --> boolean
if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($con_db, $_POST['name']);
   $email = mysqli_real_escape_string($con_db, $_POST['email']);
   $phone = mysqli_real_escape_string($con_db, $_POST['phone']);
   $password = mysqli_real_escape_string($con_db, $_POST['password']); 
   $confirm_password = mysqli_real_escape_string($con_db, $_POST['confirm_password']);

   // Truy vấn database (user)
   $use = mysqli_query($con_db, "USE `manage_account`");
   $select = mysqli_query($con_db, "SELECT * FROM `user_information` WHERE email = '$email' AND phone = '$phone'") or die('query failed');

   
   $specialChars = preg_match('@[^\w]@', $password);   
   if (mysqli_num_rows($select) > 0){ 
       $message[] = "Email và số điện thoại đã tồn tại";
   } else {
       if ($password != $confirm_password) {
       $message[] = "Mật khẩu nhập lại không chính xác";
       } else if(strlen($password) < 8 || strlen($password) > 16) {
           $message[] = "Sai định dạng mật khẩu";
       } else if(strlen($phone) < 10 || strlen($phone) > 10) {
           $message[] = "Sai định dạng số điện thoại";
       } else if(!$specialChars) {
           $message[] = "Sai định dạng mật khẩu";
       } else {
           $crypt_password = mysqli_real_escape_string($con_db, md5($_POST['password'])); 
           $insert = mysqli_query($con_db, "INSERT INTO `user_information`(name, email, phone, password) VALUES ('$name', '$email', '$phone', '$crypt_password')") or die('query failed');
           header('location:user_login.php');
       }
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Đăng ký</h3>
      <input type="text" placeholder="Tên" name="name" required class="box">
            <input type="email" placeholder="Email" name="email" required class="box" id="email">
            <input type="number" placeholder="Số điện thoại" name="phone" required class="box" id="password">
            <input type="password" placeholder="Mật khẩu (Tối thiểu 8 kí tự và ít nhất 1 kí tự đặc biệt)" name="password" required class="box">
            <input type="password" placeholder= "Nhập lại mật khẩu" name="confirm_password" required class="box">
            <!-- <input type="file" name="image" class="box" accept="image/jpg, image/png"> -->
            <input type="submit" value="Đăng ký" name="submit" class="btn">
      <p>Bạn đã có tài khoản</p>
      <a href="user_login.php" class="option-btn-1">Đăng nhập</a>
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>