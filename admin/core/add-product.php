<?php
session_start();

error_reporting(E_ALL & ~E_WARNING);
include('../config/db_connect.php');
$errors = "";
$output = "";
$imagePath = "";
$imagePathTemp = "";

if (isset($_POST)) {

    if (!empty($_POST['pr_name']) and !empty($_POST['pr_code'])  and !empty($_POST['auth_name']) and !empty($_POST['pub_name']) and !empty($_POST['pr_status']) and !empty($_POST['pr_number']) and !empty($_POST['pr_desc']) and !empty($_POST['pr_category']) and !empty($_POST['pr_price']) and !empty($_POST['pr_discount']) and !empty($_FILES['pr_images'])) {

        $pr_name =  $_POST['pr_name'];
        $pr_code = $_POST['pr_code'];

        $auth_name =  $_POST['auth_name'];
        $pub_name =  $_POST['pub_name'];
        $pr_number =  $_POST['pr_number'];
        $pr_desc =  $_POST['pr_desc'];
        $pr_category = $_POST['pr_category'];
        $pr_price = $_POST['pr_price'];
        $pr_discount = $_POST['pr_discount'];
        $pr_images = $_POST['pr_images'];
        $images = $_FILES["pr_images"];
        $pr_status = $_POST["pr_status"];

        foreach ($images["tmp_name"]  as $i => $tmp_name) {
            $ext = pathinfo($images['name'][$i], PATHINFO_EXTENSION);

            if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif') {
                $string = randomString(8);

                $imagePath .= 'img/' . $pr_code . '/' . $string . '.' . $ext . ',';
                $imagePathTemp = '../img/' . $pr_code . '/' . $string . '.' . $ext;

                mkdir(dirname($imagePathTemp));
                move_uploaded_file($images['tmp_name'][$i], $imagePathTemp);
            } else {
                echo $output = "errors";
                exit;
            }
        }

        $imgs =  rtrim($imagePath, ',');
        // print_r($arrays =  explode(',', $imgs));
        // foreach ($arrays as $array) {
        //     echo $array;
        // }
        $sql = "INSERT INTO `products`(`pr_name`, `pr_author`, `pr_pub`, `pr_category`,`pr_status`, `pr_code`, `pr_number`, 
        `pr_price`, `pr_discount`, `pr_img`, `pr_desc`) VALUES ('$pr_name','$auth_name','$pub_name','$pr_category','$pr_status','$pr_code','$pr_number',
        '$pr_price','$pr_discount','$imgs','$pr_desc')";
        $res = mysqli_query($conn, $sql);

        $query = "SELECT * from products, category where category.c_id = pr_category";
        $result = mysqli_query($conn, $query);
        $output = "";
        $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($books as $key => $book) {
            $index = $key + 1;
            $class = $book['pr_status'] == 1  ? 'color-red' :  'color-green';
            $status = $book['pr_status'] == 1  ? 'Private' :  'Public';
            $output .= "
                <tr class='table__row'>
                        <td class='table__td'>
                            " . $index . "
                        </td>
                        <td class='d-none d-lg-table-cell table__td'><span class='text-grey'>" . $book['pr_code'] . "</span>
                        </td>
                        <td class='table__td'>" . $book['pr_name'] . "</td>
                        <td class='table__td'><span class='text-grey'>" . $book['c_name'] . "</span>
                        </td>
                        <td class='table__td'><span>" . $book['pr_price'] . "</span>
                        </td>
                        <td class='d-none d-lg-table-cell table__td'><span class='text-grey'>" . $book['pr_number'] . "</span>
                        </td>
                        <td class='d-none d-sm-table-cell table__td'>
                            <div class='table__status'><span class='table__status-icon " . $class . "'></span>
                                " . $status . "</div>
                        </td>
                        <td class='table__td table__actions'>
                            <div class='items-more'>
                                <button class='items-more__button'>
                                    <svg class='icon-icon-more'>
                                        <use xlink:href='#icon-more'></use>
                                    </svg>
                                </button>
                                <div class='dropdown-items dropdown-items--right'>
                                    <div class='dropdown-items__container'>
                                        <ul class='dropdown-items__list'>
                                            <li class='dropdown-items__item'><a href='product-details.php?id=" . $book['pr_id'] . "' class='dropdown-items__link'><span class='dropdown-items__link-icon'>
                                                        <svg class='icon-icon-view'>
                                                            <use xlink:href='#icon-view'></use>
                                                        </svg></span>Details</a>
                                            </li>
                                            <li class='dropdown-items__item'><a value=" . $book['pr_id'] . " class='dropdown-items__link delete-product'><span class='dropdown-items__link-icon'>
                                                        <svg class='icon-icon-trash'>
                                                            <use xlink:href='#icon-trash'></use>
                                                        </svg></span>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
            
            ";
        }
        echo $output;
    } else echo $output = "errors";
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
