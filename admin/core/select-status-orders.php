<?php
session_start();

include('../config/db_connect.php');
if (isset($_POST['or_key'])) {
    $id =  $_POST['or_key'];
    if ($id == "0" or $id == "1" or $id == "2" or $id == "3") {
        $sql = "SELECT  * from orders, customers  where orders.cus_id = customers.cus_id and or_status = '$id'";
    } else {
        $sql = "SELECT  * from orders, customers  where orders.cus_id = customers.cus_id";
    }
    $res = mysqli_query($conn, $sql);
    $orders = mysqli_fetch_all($res, MYSQLI_ASSOC);

    if (mysqli_num_rows($res) > 0) {
        $ouput = "";
        foreach ($orders as $i => $order) {
            $count = $i + 1;
            if ($order['or_status'] == 0) {
                $status = "Đang xử lý";
            } elseif ($order['or_status'] == 1) {
                $status = "Đã xử lý";
            } elseif ($order['or_status'] == 2) {
                $status = "Đang giao hàng";
            } elseif ($order['or_status'] == 3) {
                $status = "Giao hàng thành công";
            }
            switch ($order['or_status']) {
                case 0:
                    $color = "orange";
                    break;
                case 1:
                    $color = "blue";
                    break;
                case 2:
                    $color = "blue";
                    break;
                case 3:
                    $color = "green";
                    break;
            }
            $ouput .= "
    
         <tr class='table__row'>
                                <td class='table__td'>
                                    " . $count . "
                                </td>
                                <td class='d-none d-lg-table-cell table__td'><span class='text-grey'>" . $order['or_id'] . "</span>
                                </td>
                                <td class='table__td'>" . $order['cus_name'] . "</td>
                                <td class='d-none d-sm-table-cell table__td'><span class='text-grey'>" . $order['or_pay'] . " </span>
                                </td>
                                <td class='table__td'><span>" . $order['or_total'] . "</span>
                                </td>
                                <td class='table__td text-nowrap'><span class='text-grey'>" . $order['or_date'] . " </span>
                                </td>
                                <td class='d-none d-sm-table-cell table__td'>
                                    <div class='table__status'><span class='table__status-icon color-" . $color . "'></span>
                                        " . $status . "
                                    </div>
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
                                                    <li class='dropdown-items__item'><a class='dropdown-items__link' href='order-details.php?or_id=" . $order['or_id'] . "'><span class='dropdown-items__link-icon'>
                                                                <svg class='icon-icon-view'>
                                                                    <use xlink:href='#icon-view'></use>
                                                                </svg></span>Details</a>
                                                    </li>

                                                    <li class='dropdown-items__item'><a class='dropdown-items__link' href='core/delete_orders.php?or_id=" . $order['or_id'] . "'><span class='dropdown-items__link-icon'>
                                                                <svg class='icon-icon-trash'>
                                                                    <use xlink:href='#icon-trash'></use>
                                                                </svg></span>Delete</a>
                                                    </li>
                                                    <li class='dropdown-items__item'><a class='dropdown-items__link' href='order-status.php?or_id=" . $order['or_id'] . "'><span class='dropdown-items__link-icon'>
                                                                <svg class='icon-icon-trash'>
                                                                    <use xlink:href='#icon-trash'></use>
                                                                </svg></span>Status</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
    
    ";
        }
        echo $ouput;
    }
};
