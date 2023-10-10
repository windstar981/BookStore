<?php
session_start();
    if(isset($_SESSION['id']))
    {
        if(isset($_GET['prid']))
        {
            $pr_id = $_GET['prid'];
            echo $pr_id;
            $cus_id = $_SESSION['id'];
            include('../config/db_connect.php');
            $sl_pr = "select * from carts where pr_id ='$pr_id' and cus_id='$cus_id'";
            $res_pr = mysqli_query($conn, $sl_pr);
            if(mysqli_num_rows($res_pr)>0)
            {
                $del_pr = "DELETE FROM `carts` WHERE pr_id ='$pr_id' and cus_id='$cus_id'";
                if(mysqli_query($conn, $del_pr))
                {
                    header('location: ../cart.php');
                }
                else
                {
                    header('location: ../index.php');
                }
            }
            else
            {
                header('location: ../index.php');
            }
        }
        
    }
    else
    {
        header('location: ../index.php');
    }
    

?>