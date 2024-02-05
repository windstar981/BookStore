<?php
include('../config/db_connect.php');
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Lấy dữ liệu từ form
  $title = $_POST['name'];
  $shortDescription = $_POST['short_description'];
  $image = $_FILES['image']['name'];

  $content = $_POST['description'];

  // Thực hiện các kiểm tra và xử lý dữ liệu nếu cần
  // ...

  // Thực hiện câu lệnh SQL để cập nhật thông tin bài viết
  $articleIdToUpdate = $_GET['id'];
  if (!empty($image)) {
    $image = 'img/' . $image;
    $updateSql = "UPDATE article SET 
                    title = '$title', 
                    abstract = '$shortDescription', 
                    img = '$image', 
                    description = '$content', 
                    update_at = UNIX_TIMESTAMP()
                  WHERE id = $articleIdToUpdate";
  } else {
    $updateSql = "UPDATE article SET 
                    title = '$title', 
                    abstract = '$shortDescription', 
                    description = '$content', 
                    update_at = UNIX_TIMESTAMP()
                  WHERE id = $articleIdToUpdate";
  }
  $conn->query($updateSql);



  // Xử lý upload ảnh nếu có
  if (!empty($_FILES['image']['tmp_name'])) {
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
  }

  // Chuyển hướng người dùng về trang danh sách bài viết sau khi sửa
  header('Location: index.php');
  exit();
}

// Lấy thông tin bài viết cần sửa
$articleIdToEdit = $_GET['id'];
$sql = "SELECT * FROM article WHERE id = $articleIdToEdit";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
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

  input,
  .ql-container {
    margin-bottom: 10px;
  }

  #editor,
  #shortEditor {
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
              <li class="breadcrumbs__item active"><span class="breadcrumbs__link"><?= getLang('edit_email') ?> </span>
              </li>
            </ol>
          </div>
        </div>
    </div>

    </div>
    <form method="post" action="edit.php?id=<?php echo $articleIdToEdit; ?>" enctype="multipart/form-data" class="mx-auto">
      <!-- Các trường input và textarea cho việc sửa bài viết -->
      <label for="name" class="form-label"><?= getLang('name_email') ?>:</label>
      <input type="text" name="name" class="form-control" value="<?php echo $row['title']; ?>" required>

      <label for="short_description" class="form-label"><?= getLang('abstract') ?>:</label>
      <div id="shortEditor" class="form-control" style="height: auto; max-height:1000px;"><?php echo $row['abstract']; ?></div>
      <input type="hidden" name="short_description" id="short_description" value="<?php echo $row['abstract']; ?>">

      <label for="image" class="form-label"><?= getLang('img') ?>:</label>
      <input type="file" name="image" class="form-control" accept="image/*">
      <?php
      if (!empty($row['img'])) {
        echo '<img src="' . $row['img'] . '" alt="' . $row['title'] . '" class="img-fluid" style="max-width: 150px; border-radius: 8px;">';
      }
      ?>

      <label for="content" class="form-label" style="display: block;"><?= getLang('description') ?>:</label>
      <div id="editor" class="form-control" style="height: auto; max-height:1000px;"><?php echo $row['description']; ?></div>
      <input type="hidden" name="description" id="description" value="<?php echo $row['description']; ?>">

      <button type="submit" class="btn btn-warning"><?= getLang('save') ?></button>
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