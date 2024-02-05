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
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
 

<?php require_once("templates/header.php") ?>
<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      padding: 20px;
    }

    h2 {
      color: #333;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* max-width: 600px; */
      margin: 0 auto;
    }

    label {
      margin-bottom: 5px;
    }

    input, .ql-container {
      margin-bottom: 10px;
    }

    #editor, #shortEditor {
      margin-bottom: 15px;
    }
  </style>
<main class="page-content">
    <div class="container">
    <div class="page-header">

<h1 class="page-header__title"><?= getLang('form_email') ?></h1>
</div>
<div class="page-tools">
<div class="page-tools__breadcrumbs">
    <div class="breadcrumbs">
        <div class="breadcrumbs__container">
            <ol class="breadcrumbs__list">
                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="index.php">
                        <svg class="icon-icon-home breadcrumbs__icon">
                            <use xlink:href="#icon-home"></use>
                        </svg>
                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                            <use xlink:href="#icon-keyboard-right"></use>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="index.php"><span><?= getLang('manage_email') ?></span>
                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                            <use xlink:href="#icon-keyboard-right"></use>
                        </svg></a>
                </li>
                <li class="breadcrumbs__item active"><span class="breadcrumbs__link"><?= getLang('add_email') ?></span>
                </li>
            </ol>
        </div>
    </div>
</div>

</div>
  <form action="process.php" method="post" enctype="multipart/form-data" class="mx-auto">
    <label for="name" class="form-label"><?= getLang('name_email') ?>:</label>
    <input type="text" name="name" class="form-control" required>

    <label for="short_description" class="form-label"><?= getLang('abstract') ?>:</label>
    <div id="shortEditor" class="form-control" style="height: auto; max-height:1000px;"></div>
    <input type="hidden" name="short_description" id="short_description">

    <label for="image" class="form-label"><?= getLang('img') ?>:</label>
    <input type="file" name="image" class="form-control" accept="image/*">

    <label for="content" class="form-label"><?= getLang('description') ?>:</label>
    <div id="editor" class="form-control" style="height: auto; max-height:1000px;"></div>
    <input type="hidden" name="description" id="description">

    <button type="submit" class="btn btn-primary"><?= getLang('add') ?></button>
  </form>

  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var shortQuill = new Quill('#shortEditor', {
      theme: 'snow'
    });

    var quill = new Quill('#editor', {
      theme: 'snow'
    });

    document.querySelector('form').addEventListener('submit', function(event) {
      var short_description = document.querySelector('input[name=short_description]');
      short_description.value = shortQuill.root.innerHTML;

      var description = document.querySelector('input[name=description]');
      description.value = quill.root.innerHTML;
    });
  </script>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once("templates/footer.php") ?>


</html>