<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<?php include_once'head.php' ?>

<body>
    <?php 
  $post_id=$_GET["id"];
  require_once '../common/post.php';
  ?>

    <div class="jumbotron">
        <h1 class="display-4">Bonjour <?= $_SESSION['username'];?></h1>
        <?php
  $post = get_post ($post_id);?>
        <p class="lead"><?= $post["title"]?></p>
        <hr class="my-4">
        <p><?= $post["body"]?></p>
        <a class="btn btn-primary btn-lg" href="posts.php" role="button">Back</a>
    </div>
</body>

</html>