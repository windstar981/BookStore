<?php
session_start();


include('../config/db_connect.php');
if (!isset($_GET['id']) or empty($_FILES['pr_images'])) {
    header('Location: ../404.php');
    exit;
}
$id = $_GET['id'];

// $pr_images = $_POST['pr_images'];
$images = $_FILES["pr_images"];
$imagePath = "";
$imagePathTemp = "";
$pr_code = $_POST['pr_code'];
// print_r($images);
// print_r($images["tmp_name"]);
// exit;



foreach ($images["tmp_name"]  as $i => $tmp_name) {
    $ext = pathinfo($images['name'][$i], PATHINFO_EXTENSION);

    if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif') {
        $string = randomString(8);

        $imagePath .= 'img/' . $pr_code . '/' . $string . '.' . $ext . ',';
        $imagePathTemp = '../img/' . $pr_code . '/' . $string . '.' . $ext;


        mkdir(dirname($imagePathTemp));
        move_uploaded_file($images['tmp_name'][$i], $imagePathTemp);
    } else {
        echo header("Location: ../product-details.php?id=$id&errors=2");
        exit;
    }
}

$imgs =  rtrim($imagePath, ',');


$sql = "UPDATE `products` SET `pr_img`='$imgs' WHERE pr_id = '$id'";

$res = mysqli_query($conn, $sql);
if ($res) {
    header("Location: ../product-details.php?id=$id");
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
