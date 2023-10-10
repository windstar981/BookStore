<?php
include('../config/db_connect.php');
$create_tb = "CREATE TEMPORARY TABLE summoney (
        total mediumint, or_date date)";
mysqli_query($conn, $create_tb);
$insert_data = "INSERT into summoney SELECT  sum(ors.or_total) as money, date(ors.or_date) as date_or FROM orders ors 
    where DATEDIFF(date(CURDATE()), date(ors.or_date))<=30 GROUP BY date(ors.or_date)";
mysqli_query($conn, $insert_data);
$sl_date = "with recursive all_dates(dt) as (
        -- anchor
        select DATE_SUB(curdate(),INTERVAL 7 DAY) dt
            union all 
        -- recursion with stop condition
        select dt + interval 1 day from all_dates where dt + interval 1 day < curdate()
    )
    select d.dt date, coalesce(t.total, 0) total
    from all_dates d
    left join summoney t on t.or_date = d.dt
    order by d.dt";
    $data = mysqli_query($conn, $sl_date);
    $lb = "";
    $val_new = "[";
    $sum_money_new = 0;
    while($row = mysqli_fetch_assoc($data))
    {
        $lb .= $row['date'].";";
        $val_new .= $row['total'].",";
        $sum_money_new += $row['total'];
    }
    $lb = substr($lb, 0, -1);
    $val_new = substr($val_new, 0, -1);
    $val_new .= "]";
    $create_tb = "CREATE TEMPORARY TABLE summoney1 (
        total mediumint, or_date date)";
    mysqli_query($conn, $create_tb);
    $insert_data = "INSERT into summoney1 SELECT  sum(ors.or_total) as money, date(ors.or_date) as date_or FROM orders ors 
    where DATEDIFF(date(CURDATE()), date(ors.or_date))<=30 GROUP BY date(ors.or_date)";
    mysqli_query($conn, $insert_data) ;
    $sl_date = "with recursive all_dates(dt) as (
        -- anchor
        select DATE_SUB(curdate(),INTERVAL 14 DAY) dt
            union all 
        -- recursion with stop condition
        select dt + interval 1 day from all_dates where dt + interval 1 day < DATE_SUB(curdate(),INTERVAL 7 DAY)
    )
    select d.dt date, coalesce(t.total, 0) total
    from all_dates d
    left join summoney1 t on t.or_date = d.dt
    order by d.dt";
    $data = mysqli_query($conn, $sl_date);
    $val_old = "[";
    $sum_money_old = 0;
    while($row = mysqli_fetch_assoc($data))
    {
        //$lb .= $row['date'].",";
        $val_old .= $row['total'].",";
        $sum_money_old += $row['total'];
    }
    $val_old = substr($val_old, 0, -1);
    $val_old .="]";
    $create_tb = "CREATE TEMPORARY TABLE summoney1 (
        total mediumint, or_date date)";
    mysqli_query($conn, $create_tb);
    $insert_data = "CREATE TEMPORARY TABLE sumpr
    SELECT sum(od_quatity) as sum, date(ors.or_date) as date FROM `orderdetail` od, orders ors 
    WHERE ors.or_id = od.or_id and datediff(DATE_SUB(curdate(),INTERVAL 1 DAY), or_date)<7 
    and datediff(DATE_SUB(curdate(),INTERVAL 1 DAY), or_date)>=0   
    GROUP BY date(ors.or_date)";
    mysqli_query($conn, $insert_data) ;
    $sl_date = "with recursive all_dates(dt) as (
        -- anchor
        select DATE_SUB(curdate(),INTERVAL 7 DAY) dt
            union all 
        -- recursion with stop condition
        select dt + interval 1 day from all_dates where dt + interval 1 day <= DATE_SUB(curdate(),INTERVAL 1 DAY)
    )
    select d.dt date, coalesce(t.sum, 0) total
    from all_dates d
    left join sumpr t on t.date = d.dt
    order by d.dt";
    $data = mysqli_query($conn, $sl_date);
    $val_pr = "[";
    while($row = mysqli_fetch_assoc($data))
    {
        //$lb .= $row['date'].",";
        $val_pr .= $row['total'].",";
    }
    $val_pr = substr($val_pr, 0, -1);
    $val_pr .="]";
    if($sum_money_old==0)
    {
        $percent_money = 100;
    }
    else
    {
        $percent_money = (($sum_money_new-$sum_money_old)/$sum_money_old)*100;
    }
    //tuần trước nữa
    $create_tb = "CREATE TEMPORARY TABLE summoney1 (
        total mediumint, or_date date)";
    mysqli_query($conn, $create_tb);
    $insert_data = "CREATE TEMPORARY TABLE sumpr
    SELECT sum(od_quatity) as sum, date(ors.or_date) as date FROM `orderdetail` od, orders ors 
    WHERE ors.or_id = od.or_id and datediff(DATE_SUB(curdate(),INTERVAL 1 DAY), or_date)<7 
    and datediff(DATE_SUB(curdate(),INTERVAL 1 DAY), or_date)>=0   
    GROUP BY date(ors.or_date)";
    mysqli_query($conn, $insert_data) ;
    $sl_date = "with recursive all_dates(dt) as (
        -- anchor
        select DATE_SUB(curdate(),INTERVAL 14 DAY) dt
            union all 
        -- recursion with stop condition
        select dt + interval 1 day from all_dates where dt + interval 1 day <= DATE_SUB(curdate(),INTERVAL 8 DAY)
    )
    select d.dt date, coalesce(t.sum, 0) total
    from all_dates d
    left join sumpr t on t.date = d.dt
    order by d.dt";
    $data = mysqli_query($conn, $sl_date);
    $sum_money_old_old = 0;
    while($row = mysqli_fetch_assoc($data))
    {
        $sum_money_old_old += $row['total'];
    }
    
    if($sum_money_old_old==0)
    {
        $percent_money_old = $sum_money_old;
    }
    else
    {
        $percent_money_old = (($sum_money_old-$sum_money_old_old)/$sum_money_old_old)*100;
    }
?>
