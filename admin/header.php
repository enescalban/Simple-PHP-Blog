<?php
session_start();
//unset($_SESSION['username']);
require_once '../system/db.php';

$stmt_user = $db->query("SELECT post_id, post_title,post_seo_url, post_author, post_date FROM posts");


// Eğer oturum yoksa kullanıcıyı yönlendir
if (!isset($_SESSION['username'])) {
    // Kullanıcıyı giriş sayfasına yönlendir
    header("Location: login.php");
    exit();
}

// Giriş yapan kullanıcının kullanıcı adını alın
$username = $_SESSION['username'];

// Kullanıcı verilerini MySQL veritabanından çekin
$stmt = $db->prepare("SELECT * FROM users WHERE username_u = :username");
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['postdelete'])) {
    $post_id = $_POST['postdelete'];
    $deleteStmt = $db->prepare("DELETE FROM posts WHERE post_id = :post_id");
    $deleteStmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $deleteStmt->execute();
    $_SESSION['postdelete'] = "true";
    header("Location:index.php");
}

if (isset($_POST['postupdate'])) {
    $postupdateid = $_POST['postupdate'];
    $_SESSION['postupdateid'] = $postupdateid;
    header("Location:edit.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="container">


        <br>
        <div class="alert alert-primary"> Welcome administrator. <?php echo $user['username_u']; ?> You can manage your website using the buttons below.</div>
        <hr>

        <a href="add_post.php"><button class="btn btn-primary btn-sm">Add Posts</button></a>
        <a href="manage.php"><button class="btn btn-success btn-sm">Manage Website</button></a>
        <a href="logout.php"><button class="btn btn-danger btn-sm">Logout</button></a>




        <br><br>