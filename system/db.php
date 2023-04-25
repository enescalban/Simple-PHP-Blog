<?php

// Veritabanı bilgileri
$host = 'localhost';
$dbname = 'chatgptblog';
$username = 'root';
$password = 'mysql';

// PDO ile veritabanına bağlanma
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Veritabanına başarıyla bağlandınız!<br>";

} catch(PDOException $e) {
    echo "Veritabanı bağlantısı başarısız: " . $e->getMessage();
}


?>
