<?php
$setting_id = 1;
require_once 'header.php';

$query = "SELECT * FROM settings WHERE setting_id = 1";
$stmt = $db->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['websiteupdate'])) {

    $blog_title = strip_tags($_POST['blog_title']);
    $blog_desc = strip_tags($_POST['blog_desc']);
    $blog_logo_title = strip_tags($_POST['blog_logo_title']);
    $blog_footer = strip_tags($_POST['blog_footer']);
    $blog_twitter = strip_tags($_POST['blog_twitter']);
    $blog_facebook = strip_tags($_POST['blog_facebook']);
    $blog_github = strip_tags($_POST['blog_github']);

    $updatewebsite = $db->prepare("UPDATE settings SET 
    blog_title = :blog_title, 
    blog_desc = :blog_desc, 
    blog_logo_title = :blog_logo_title, 
    blog_footer = :blog_footer, 
    blog_twitter = :blog_twitter, 
    blog_facebook = :blog_facebook, 
    blog_github = :blog_github 
    WHERE setting_id = 1");

    $updatewebsite->bindParam(':blog_title', $blog_title);
    $updatewebsite->bindParam(':blog_desc', $blog_desc);
    $updatewebsite->bindParam(':blog_logo_title', $blog_logo_title);
    $updatewebsite->bindParam(':blog_footer', $blog_footer);
    $updatewebsite->bindParam(':blog_twitter', $blog_twitter);
    $updatewebsite->bindParam(':blog_facebook', $blog_facebook);
    $updatewebsite->bindParam(':blog_github', $blog_github);

    $updatewebsite->execute();

    header("Location:index.php");
}

?>
<form method="post" action="">
    <input name="websiteupdate" type="hidden">
    <div class="mb-3">
        <label for="blog_title" class="form-label">Blog Başlığı</label>
        <input type="text" class="form-control" id="blog_title" name="blog_title" value="<?php echo $row['blog_title']; ?>">
    </div>
    <div class="mb-3">
        <label for="blog_desc" class="form-label">Blog Açıklaması</label>
        <textarea class="form-control" id="blog_desc" name="blog_desc"><?php echo $row['blog_desc']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="blog_logo_title" class="form-label">Logo Başlığı</label>
        <input type="text" class="form-control" id="blog_logo_title" name="blog_logo_title" value="<?php echo $row['blog_logo_title']; ?>">
    </div>
    <div class="mb-3">
        <label for="blog_footer" class="form-label">Footer</label>
        <textarea class="form-control" id="blog_footer" name="blog_footer"><?php echo $row['blog_footer']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="blog_twitter" class="form-label">Twitter</label>
        <input type="text" class="form-control" id="blog_twitter" name="blog_twitter" value="<?php echo $row['blog_twitter']; ?>">
    </div>
    <div class="mb-3">
        <label for="blog_facebook" class="form-label">Facebook</label>
        <input type="text" class="form-control" id="blog_facebook" name="blog_facebook" value="<?php echo $row['blog_facebook']; ?>">
    </div>
    <div class="mb-3">
        <label for="blog_github" class="form-label">Github</label>
        <input type="text" class="form-control" id="blog_github" name="blog_github" value="<?php echo $row['blog_github']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Güncelle</button>
</form>