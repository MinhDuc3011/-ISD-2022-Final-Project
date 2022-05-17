<?php

include './components/connect.php';
session_start();

if (isset($_POST["submit_email"])) {
    $use = mysqli_query($con_db, "USE `manage_account`");

    $email = mysqli_real_escape_string($con_db, $_POST["email"]);
    $check_email = mysqli_query($con_db, "SELECT * FROM `user_information` WHERE email='$email'") or die('query failed');


    if (mysqli_num_rows($check_email) > 0) {
        $data = mysqli_fetch_assoc($check_email);
        $password = rand(999, 99999);
        $password_hash = md5($password);
        $update_password = mysqli_query($con_db, "UPDATE `user_information` SET password='$password_hash' WHERE email='$email'") or die('query failed');
        
        $to = $email;
        $subject = "Đặt lại mật khẩu";

        $message_mail = "
        <html>
        <head>
        <title>{$subject}</title>
        </head>
        <body>
        <p>Mật khẩu mới của bạn là: {$password}</p>
        <p>Bạn vui lòng đăng nhập lại theo link dưới đây và đổi lại mật khẩu ngay sau khi đăng nhập</p>
        <p><a href='{$link_reset}'>Đăng nhập</a></p>

        </body>
        </html>
        ";


        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    

        $headers .= "From: ". $my_email;

        if (mail($to,$subject,$message_mail,$headers)) {
            $message[] = "Chúng tôi đã gửi mật khẩu mới đến email của bạn - {$email}.";
        } else {
            $message[] = "Mail chưa được gửi, vui lòng kiểm tra lại";
        }
    }
    else {
        $message[] = "Email của bạn chưa được đăng ký";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include 'components/user_header.php'; ?>
    <section class="form-container">

        <form action="" method="post" enctype="multipart/form-data" >
            <h3>Cấp lại mật khẩu</h3>
            
            <p>Vui lòng nhập email bạn đã đăng ký</p>
            <input type="email" placeholder="Email" name="email" required class="box">
            <input type="submit" value="Cấp lại mật khẩu" name="submit_email" class="btn">
        </form>
    </section>

    
    <?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>