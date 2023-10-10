<?php
session_start();

if (isset($_POST['stt']) && isset($_POST['id_or'])) {
    include('../config/db_connect.php');
    $u_id = $_SESSION['u_id'];
    $stt =  $_POST['stt'];
    $id_or = $_POST['id_or'];
    
    echo $stt;
    echo $id_or;
    echo $id_user;
    $update_stt = "UPDATE orders SET or_status = '$stt' , u_id = '$u_id' where or_id = '$id_or'";
    if (mysqli_query($conn, $update_stt)) {
        header('location: ../orders.php');
    }
}
