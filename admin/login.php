<?php
session_start();
ob_start();
error_reporting(0);

require_once '../system/db.php';

if (isset($_POST['username'])) {

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $md5pass = md5($password);

    $kullanicisor = $db->prepare("SELECT * FROM users WHERE username_u = :user AND password_p = :pass");
    $kullanicisor->execute(array(
        'user' => $username,
        'pass' => $md5pass
    ));

    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

    if ($kullanicisor->rowCount() > 0) {
       
        $_SESSION['msg'] = "true";
        // Session'a kullanıcı bilgileri eklenir.
        $_SESSION['username'] = $username;
        header("Refresh: 2; url=index.php");
    } else {
        $_SESSION['msg'] = "false";
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Girişi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Admin Girişi</h2>
        <br>
        <?php
        if (isset($_SESSION['msg']) && $_SESSION['msg'] == "true") {
            echo '<div class="alert alert-success">Giriş başarılı. Yönlendiriliyorsunuz...</div>';
            unset($_SESSION['msg']);
        }        
        ?>
         <?php
        if (isset($_SESSION['msg']) && $_SESSION['msg'] == "false") {
            echo '<div class="alert alert-danger">Kullanıcı adı veya şifre yanlış.</div>';
            unset($_SESSION['msg']);
        }        
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Kullanıcı adınızı girin">
            </div>
            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Şifrenizi girin">
            </div>
            <button type="submit" class="btn btn-primary">Giriş Yap</button>
        </form>
    </div>
</body>
<script>
// URL parametrelerini almak için bir fonksiyon oluşturuyoruz
function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

// msg parametresi true olarak belirtilmişse 2 saniye sonra yönlendirme yapılıyor
if (getParameterByName('msg') === 'true') {
  setTimeout(function() {
    window.location.href = "index.php";
  }, 2000); // 2 saniye sonra yönlendirme yapılacak
}

  </script>
</html>