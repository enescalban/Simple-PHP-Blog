<?php 
require_once 'header.php';
require_once 'seo.php';


if (isset($_POST['addpost'])) {

    $post_title = isset($_POST['post_title']) ? $_POST['post_title'] : '';
    $post_content = isset($_POST['post_content']) ? $_POST['post_content'] : '';
    $post_author = isset($_POST['post_author']) ? $_POST['post_author'] : '';
    $post_seo_url = seo_fonksiyonu($post_title);

    // INSERT INTO sorgusu
    $sql = "INSERT INTO posts (post_title, post_author, post_content, post_seo_url) VALUES (:post_title, :post_author, :post_content, :post_seo_url)";

    // PDO prepare kullanarak sorguyu hazırlıyoruz
    $stmt = $db->prepare($sql);

    // Parametreleri bağlıyoruz
    $stmt->bindParam(':post_title', $post_title);
    $stmt->bindParam(':post_author', $post_author);
    $stmt->bindParam(':post_content', $post_content);
    $stmt->bindParam(':post_seo_url', $post_seo_url);

    // Sorguyu çalıştırıyoruz
    $stmt->execute();

    $_SESSION['postadded'] = "true";
    header("Location:index.php");
}

?>

<br>

<form method="post" action="">
    <input type="hidden" name="addpost">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" placeholder="Enter Post Title" id="post_title" name="post_title">
    </div>
    <br>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" placeholder="Enter Post Author" id="post_author" name="post_author">
    </div>
    <br>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="post_content" placeholder="Enter Post Seo Content" name="post_content" rows="10"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Add Post</button>
</form>
