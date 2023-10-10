<?php


include('../config/db_connect.php');
if (!isset($_POST['pr_key'])) {
    header("Location: manager.php");
    exit;
}

$word = $_POST['pr_key'];
if (empty($word)) {
    echo "none";
    exit;
}
$sql = "SELECT  * from products where pr_status = 2 and pr_name like '%$word%' or pr_code like '%$word%' or pr_author like '%$word%' or pr_pub like '%$word%' ";
$res = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($res, MYSQLI_ASSOC);

if (mysqli_num_rows($res) > 0) {
    $ouput = "";
    foreach ($products as $i => $product) {
        $name_img = explode(",", $product['pr_img'])[0];
        $ouput .= "
        <div class='autocomplete-suggestion' onclick='window.location='/product-details.php?idsp=" . $product['pr_id'] . "''>
         <table>
             <tbody id='live-search'>
            <tr>
                <td style='vertical-align:top'>
                
                <a href='product-details.php?idsp=" . $product['pr_id'] . "'>
                        <img src='admin/" . $name_img . "' width='60' height = '70'  style='margin-right:10px; max-width:none'>
                </a>
                
                </td>
                <td class ='ml-2' style='vertical-align:top; line-height:18px;'><a class='suggest_link' href='product-details.php?idsp=" . $product['pr_id'] . "'>" . $product['pr_name'] . "</a><br>
                <span class='text-secondary mt-1'>Tác giả: " . $product['pr_author'] . "</span>
                <br>
                <span class='text-danger mt-1'>Giá: " . number_format($product['pr_price'] - $product['pr_discount'], 0, ',', '.') . " VNĐ
            </span></td>
            </tr>  
            </tbody>
            </table>
        </div> 
    ";
    }
    echo $ouput;
}
