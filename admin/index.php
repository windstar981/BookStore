<?php
include('../config/db_connect.php');
session_start();

$postsPerPage = 10;

if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

$start = ($currentPage - 1) * $postsPerPage;
$searchTerm = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    // Nếu có, thực hiện truy vấn tìm kiếm
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM article WHERE title LIKE '%$searchTerm%' ORDER BY created_at DESC";
    $result = $conn->query($sql);
} else {
    // Nếu không, thực hiện truy vấn hiển thị bình thường
    $sql = "SELECT * FROM article ORDER BY created_at DESC LIMIT $start, $postsPerPage";
    $result = $conn->query($sql);
}

$totalPosts = $conn->query("SELECT COUNT(id) as total FROM article")->fetch_assoc()['total'];
$totalPages = ceil($totalPosts / $postsPerPage);
?>
<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">


<?php require_once("templates/header.php") ?>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        .post {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
            min-height: 150px;
            display: flex;
            align-items: center;
        }

        .post img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            margin-right: 20px;
        }

        .post-content {
            flex-grow: 1;
        }

        .post-title {
            color: #343a40;
        }

        .post-description {
            color: #6c757d;
            margin-top: 10px;
        }

        .pagination {
            justify-content: center !important;
            margin-top: 20px;
        }

        .btn {
            margin-right: 10px;
        }
    </style>
<main class="page-content">
<div class="container">
        
        <h2><?= getLang('manage_email') ?></h2>
        <form action="index.php" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="<?= getLang('placeholder_search') ?>" value="<?php echo $searchTerm;?>">
            <button type="submit" class="btn btn-secondary"><?= getLang('search') ?></button>
        </div>
    </form>
                <!-- Nút "Thêm" -->
        <a href="add.php" class="btn btn-primary mb-3"><?= getLang('add_email') ?></a>
        <?php
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="post">';
                echo '<img src="' . $row['img'] . '" alt="' . $row['title'] . '" class="img-fluid" style="max-width: 150px;">';
                echo '<div class="post-content">';
                echo '<h3 class="post-title mb-3">' . $row['title'] . '</h3>';
                echo '<p class="post-description mb-3">' . $row['abstract'] . '</p>';
                echo '<p class="mb-2"><strong>'.getLang('created_at').':</strong> ' . date('d-m-Y', $row['created_at']) . '</p>';
                // Nút "Sửa"
                echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-warning">'.getLang('edit').'</a>';
                // Nút "Xóa"
                echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger">'.getLang('delete').'</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Không có bài viết nào.</p>";
        }
        ?>
        <div style="display: flex;
    flex-direction: column;">
            <ul class="pagination" style="background-clip: text;">
                <?php
                if ($num_rows > 0)
                {
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?page=$i";
                        if($searchTerm != ""){
                            echo "&search=".$searchTerm;
                        }
                        echo "'>$i</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once("templates/footer.php") ?>


</html>