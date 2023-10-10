<?php

include('../config/db_connect.php');
if (!isset($_POST['pr_key'])) {
    header("Location: manager.php");
    exit;
}

$word = $_POST['pr_key'];
$sql = "SELECT * from customers where cus_name like '%$word%' or cus_mail like '%$word%' or cus_tel like '%$word%'";
$res = mysqli_query($conn, $sql);
$customers = mysqli_fetch_all($res, MYSQLI_ASSOC);

if (mysqli_num_rows($res) > 0) {
    $ouput = "";
    foreach ($customers as $i => $customer) {
        $cus_id = $customer['cus_id'];
        $count = $i + 1;
        $status = $customer['status'] == 1 ? "Đã kích hoạt" : "Chưa kích hoạt";
        $color_Status = $customer['status'] == 1 ? "color-green" : "color-red";
        $query = "SELECT count(or_id) as count from orders where cus_id = '$cus_id'";
        $count_or = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $ouput .= "
    
          <tr class='table__row'>
                                <td class='table__td'>
                                    <div class='table__checkbox table__checkbox--all'>

                                    </div>
                                </td>
                                <td class='table__td'>
                                    <div class='media-item media-item--medium'>

                                        <div class='media-item__right'>
                                            <h5 class='media-item__title'>
                                                <div>" . $customer['cus_name'] . "</div>
                                            </h5><a class='text-sm text-grey' href='mailto:#'>" . $customer['cus_mail'] . "</a>
                                        </div>
                                    </div>
                                </td>
                                <td class='table__td text-light-theme'>" . $customer['cus_tel'] . "</td>

                                <td class='table__td text-light-theme'>" . $customer['cus_add'] . "</td>
                                <td class='table__td text-dark-theme'>" . $count_or['count'] . "</td>
                                <td class='table__td text-light-theme'>" . $customer['cus_create'] . "</td>
                                <td class='table__td d-none d-sm-table-cell'>
                                    <div class='table__status'><span class='table__status-icon " . $color_Status . "'></span>" . $status . " </div>
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


                                                    <li class='dropdown-items__item'><a href='core/delete-customer.php?id=" . $customer['cus_id'] . "' class='dropdown-items__link'><span class='dropdown-items__link-icon'>
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
    echo $ouput;
};
