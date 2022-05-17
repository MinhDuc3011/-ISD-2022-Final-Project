<?php

include './components/connect.php';

session_start();

$user_id = $_SESSION['user_id'];


if (isset($_POST['submit'])) {
   $use = mysqli_query($con_db, "USE `manage_account`");
   $update_name = mysqli_real_escape_string($con_db, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($con_db, $_POST['update_email']);
   $update_phone = mysqli_real_escape_string($con_db, $_POST['update_phone']);
   
   $old_password = $_POST["old_password"];
   $current_password = mysqli_real_escape_string($con_db, md5($_POST["current_password"])); 
   $new_password = mysqli_real_escape_string($con_db, $_POST["new_password"]); 
   $confirm_password = mysqli_real_escape_string($con_db, $_POST["confirm_password"]); 

   $select = mysqli_query($con_db, "SELECT * FROM `user_information` WHERE email = '$update_email' AND phone = '$update_phone'") or die('query failed');
   

   $specialChars = preg_match('@[^\w]@', $new_password);

   if (!empty($current_password) || !empty($new_password)|| !empty($confirm_password)) {
       if($current_password != $old_password) {
           $message[] = "Mật khẩu hiện tại không chính xác";
       } else if ($new_password != $confirm_password) {
           $message[] = "Mật khẩu nhập lại không chính xác";
       } else if(strlen($new_password) < 8 || strlen($new_password) > 16) {
           $message[] = "Sai định dạng mật khẩu";         
       } else if(strlen($update_phone) < 10 || strlen($update_phone) > 10) {
           $message[] = "Sai định dạng số điện thoại";
       } else if (!$specialChars) {
           $message[] = "Sai định dạng mật khẩu";         
       }else {
           $use = mysqli_query($con_db, "USE `manage_account`");
           $new_crypt = mysqli_real_escape_string($con_db, md5($_POST['new_password'])); 
           mysqli_query($con_db, "UPDATE `user_information` SET name = '$update_name', email = '$update_email', phone = '$update_phone', password = '$new_crypt' WHERE id = '$user_id'") or die('query failed');
           $message[] = "Cập nhật thành công";
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
    <title>Cập nhật thông tin</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <section class="form-container">

        <form action="" method="post">
            <h3>Cập nhật thông tin</h3>
            <input type="text" placeholder="Tên" name="update_name" value="<?php echo $fetch['name']; ?>" class="box"
                required>
            <input type="email" placeholder="Email" name="update_email" value="<?php echo $fetch['email']; ?>"
                class="box" required>
            <input type="phone" placeholder="Phone" name="update_phone" value="<?php echo $fetch['phone']; ?>"
                class="box" required>
            <input type="hidden" name="old_password" value="<?php echo $fetch['password']; ?>">
            <input type="password" placeholder="Mật khẩu hiện tại" name="current_password" class="box" required>
            <input type="password" placeholder="Mật khẩu mới" name="new_password" class="box" required>
            <input type="password" placeholder="Nhập lại mật khẩu" name="confirm_password" class="box" required>
            <input type="submit" value="Cập nhật" class="btn" name="submit">
        </form>

    </section>













    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>