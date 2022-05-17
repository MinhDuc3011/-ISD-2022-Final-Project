<?php
if (isset($_POST['add_to_cart'])) {

    if ($user_id == '') {
       
    } else {

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $qty = $_POST['qty'];

        $use = mysqli_query($con, "USE `test`");
        $select = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$name' AND user_id = '$user_id'");

        if (mysqli_num_rows($select) > 0) {
            $message[] = 'Sản phẩm đã có trong giỏ hàng';
        } else {
            $use = mysqli_query($con, "USE `test`");

            $insert_cart = mysqli_query($con, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id','$pid','$name','$price','$qty','$image')");
            $message[] = 'Sản phẩm đã được thêm vào giỏ hàng';
        }
    }
}
