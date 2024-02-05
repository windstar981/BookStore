<?php
include('../config/db_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Xử lý khi người dùng click nút "Xóa"
    $articleIdToDelete = $_GET['id'];
    // Thực hiện câu lệnh SQL để xóa bài viết có ID là $articleIdToDelete
    $deleteSql = "DELETE FROM article WHERE id = $articleIdToDelete";
    $conn->query($deleteSql);

    // Chuyển hướng người dùng về trang danh sách bài viết sau khi xóa
    header('Location: index.php');
    exit();
}
?>

<!-- ... (phần còn lại của trang) ... -->
