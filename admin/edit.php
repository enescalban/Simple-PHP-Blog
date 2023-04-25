<?php require_once 'header.php';


if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    // Rakam harici bir şey varsa veya boşsa, index.php'ye yönlendirilir
    if (!is_numeric($post_id)) {
        header("Location: index.php");
        exit;
    } else {
        // Değer sayısal bir değer ise, veritabanında kayıt olup olmadığı kontrol edilir
        $stmt = $db->prepare('SELECT post_title, post_author, post_content FROM posts WHERE post_id = :post_id');
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        // Kayıt varsa, veriler değişkenlere atanır
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $post_title = $result['post_title'];
            $post_author = $result['post_author'];
            $post_content = $result['post_content'];
        } else {
            header("Location:index.php");
        }
    }
} else {
    header("Location:index.php");
}



$postsor = $db->prepare("SELECT * FROM posts where post_id=:id");
$postsor->execute(array(
    'id' => $_GET['post_id']
));

$result = $postsor->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['postupdate'])) {

    $post_id = $_POST['post_id'];

    $ayarkaydet = $db->prepare("UPDATE posts SET
		post_title=:post_title,
		post_author=:post_author,
		post_seo_url=:post_seo_url,
		post_content=:post_content
		WHERE post_id={$_POST['post_id']}");

    $update = $ayarkaydet->execute(array(
        'post_title' => $_POST['post_title'],
        'post_author' => $_POST['post_author'],
        'post_seo_url' => $_POST['post_seo_url'],
        'post_content' => $_POST['post_content']
    ));


    if ($update) {

        $_SESSION['postupdate'] = "true";
        Header("Location:index.php");
    } else {

        Header("Location:index.php");
    }
}

?>

<br>

<form method="post" action="">
    <input type="hidden" name="postupdate">
    <input value="<?php echo $result['post_id']; ?>" type="hidden" name="post_id">
    <div class="form-group">
        <label for="post_title">Post Başlığı</label>
        <input type="text" class="form-control" id="post_title" value="<?php echo $result['post_title']; ?>" name="post_title">
    </div>
    <br>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" id="post_author" value="<?php echo $result['post_author']; ?>" name="post_author">
    </div>
    <br>
    <div class="form-group">
        <label for="post_seo_url">Post SEO URL</label>
        <input type="text" class="form-control" value="<?php echo $result['post_seo_url']; ?>" id="post_seo_url" name="post_seo_url">
    </div>
    <br>
    <div class="form-group">
        <label for="post_content">Post İçeriği</label>
        <textarea class="form-control" id="post_content" name="post_content" rows="10"><?php echo $result['post_content']; ?>"</textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Güncelle</button>
</form>