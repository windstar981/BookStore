<?php
session_start();

include('../config/db_connect.php');
$errors = "";
$output = "";
$imagePath = "";
$imagePathTemp = "";

if (isset($_POST)) {

    if (!empty($_POST['title']) and !empty($_POST['link']) and !empty($_FILES['image'])) {

        $ba_title =  $_POST['title'];
        $ba_link = $_POST['link'];


        $image = $_FILES["image"];

        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);

        if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif') {
            $string = randomString(8);

            $imagePath .= 'img/banner/' . $string . '/' . $image['name'];
            $imagePathTemp = '../img/banner/' . $string . '/' . $image['name'];
            mkdir(dirname($imagePathTemp));
            move_uploaded_file($image['tmp_name'], $imagePathTemp);
        } else {
            header("Location: ../add-banners.php?errors=1");
            exit;
        }



        $sql = "INSERT INTO banners (ba_title, ba_link, ba_image) VALUES ('$ba_title','$ba_link', '$imagePath')";
        $res = mysqli_query($conn, $sql);
        if ($res) header("Location: ../add-banners.php");
    } else {
        header("Location: ../add-banners.php?errors=2");
        exit;
    }
} else {
    header("Location: ../404.php");
}



function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        # code...
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}
