<?php

function getAllFiles() {
    $allFiles = array();
    $allDirs = glob('uploads/*');
    foreach ($allDirs as $dir) {
        $allFiles = array_merge($allFiles, glob($dir . "/*"));
    }
    return $allFiles;
}

function uploadFiles($uploadedFiles) {
    $files = array();
    $errors = array();
    $returnFiles = array();
    //Xử lý gom dữ liệu vào từng file đã upload
    // var_dump($uploadedFiles);exit;
    foreach ($uploadedFiles as $key => $values) {
        if(is_array($values)){
            foreach ($values as $index => $value) {
                $files[$index][$key] = $value;
            }
        }else{
            $files[$key] = $values;
        }
    }
    $uploadPath = "../uploads/" . date('d-m-Y', time());
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    if(is_array(reset($files))){ //Up nhiều ảnh
        foreach ($files as $file) {
            $result = processUploadFile($file,$uploadPath);
            if($result['error']){
                $errors[] = $result['message'];
            }else{
                $returnFiles[] = $result['path'];
            }
        }
    }else{ //Up 1 ảnh
        $result = processUploadFile($files,$uploadPath);
        if($result['error']){
            return array(
                'errors' => $result['message']
            );
        }else{
            return array(
                'path' => $result['path']
            );
        }
    }
    return array(
        'errors' => $errors,
        'uploaded_files' => $returnFiles
    );
}

function processUploadFile($file,$uploadPath){
    $file = validateUploadFile($file, $uploadPath);
    if ($file != false) {
        $file["name"] = str_replace(' ','_',$file["name"]);
        if(move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"])){
            return array(
                'error'=>false,
                'path' => str_replace('../', '/', $uploadPath) . '/' . $file["name"]
            );
        }
    }else{
        return array(
            'error'=>false,
            'message' => "File tải lên " . basename($file["name"]) . " không hợp lệ."
        );
    }
}

//Check file hợp lệ
function validateUploadFile($file, $uploadPath) {
    //Kiểm tra xem có vượt quá dung lượng cho phép không?
    if ($file['size'] > 2 * 1024 * 1024) { //max upload is 2 Mb = 2 * 1024 kb * 1024 bite
        return false;
    }
    //Kiểm tra xem kiểu file có hợp lệ không?
    $validTypes = array("jpg", "jpeg", "png", "bmp","xlsx","xls");
    $fileType = strtolower(substr($file['name'], strrpos($file['name'], ".") + 1));
    if (!in_array($fileType, $validTypes)) {
        return false;
    }
    //Check xem file đã tồn tại chưa? Nếu tồn tại thì đổi tên
    $num = 0;
    $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
        $fileName = $fileName . "(" . $num . ")";
        $num++;
    }
    if($num != 0){
        $fileName = substr($file['name'], 0, strrpos($file['name'], ".")). "(" . $num . ")";
    }else{
        $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    }
    $file['name'] =  $fileName . '.' . $fileType;
    return $file;
}

//Hàm login sau khi mạng xã hội trả dữ liệu về
function loginFromSocialCallBack($socialUser) {
    include './connect_db.php';
    $result = mysqli_query($con, "SELECT id,username,email,fullname from user WHERE `email` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $result = mysqli_query($con, "INSERT INTO user (fullname,email VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "');");
        if (!$result) {
            echo mysqli_error($con);
            exit;
        }
        $result = mysqli_query($con, "SELECT id,username,email,fullname from user WHERE `email` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['current_user'] = $user;
        header('Location: ../login.php');
    }
}
