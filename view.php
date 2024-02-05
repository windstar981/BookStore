<?php require_once("templates/header.php") ?>
<?php
include('config/db_connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$articleIdToView = $_GET['id'];
$sql = "SELECT * FROM article WHERE id = $articleIdToView";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><?= getLang('home') ?></a></li>
                    <li class="breadcrumb-item active"><?= getLang('content') ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
        body {
            font-family: 'Arial', sans-serif;
            /* background-color: #f8f9fa; */
            background-color: pink;
            padding: 20px;
        }

        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        .post {
            background-color: #ffffff96;
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
        #emailContent {
            background-color: #f8f9fa; /* Change background color as per your preference */
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        #copyButton {
            float: right; /* Align the button to the right */
            background-color: pink;
            border-color: #c4c4c429;
            color: var(--text-secondary-color);
            padding: 4px 15px; /* Add padding for better visual appearance */
            border-radius: 5px; /* Add border-radius for rounded corners */
            cursor: pointer; /* Change cursor to pointer on hover */
            transition: background-color 0.3s ease, color 0.3s ease; /* Add smooth transition effect */
        }

        #copyButton:hover {
            background-color: #a0a0a0; /* Change background color on hover */
            color: white; /* Change text color on hover */
        }
        .article-container {
            background-color: #ffffff96;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            /* max-width: 600px; */
        }
        .article-container img {
            max-height: 100%;
            max-width: 100%;
            /* width: 100%;
            height: 100px; */
            border-radius: 8px;
            margin-bottom: 10px;
            object-fit: cover; /* Prevents the image from being distorted */
            object-position: center; /* Center the image within the container */
            background-color: #f8f9fa; /* Placeholder background color */
        }
    </style>
<main class="page-content">
<div class="container">

    <div class="article-container mb-5">
        <div style="height: 200px; width:100%; text-align:center;">
        <?php if (!empty($row['img'])) : ?>
        <img src="<?php echo 'admin/'.$row['img']; ?>" alt="<?php echo $row['title']; ?>">
        <?php endif; ?>
        </div>
        <label class="form-label"><?= getLang('name_email') ?>:</label>
        <p><?php echo $row['title']; ?></p>

        <label class="form-label"><?= getLang('abstract') ?>:</label>
        <p><?php echo $row['abstract']; ?></p>

        

        <label class="form-label"><?= getLang('description') ?>:</label>
        <label id="copyButton" class="">Copy</label>

        <div id="emailContent"><?php echo $row['description']; ?></div>

    </div>

<script>
  document.getElementById('copyButton').addEventListener('click', function () {
    var emailContent = document.getElementById('emailContent');
    var range = document.createRange();
    range.selectNode(emailContent);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
  });
</script>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>



<?php require_once("templates/footer.php") ?>

</html>