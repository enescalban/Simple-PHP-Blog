<?php

function seo_fonksiyonu($baslik) {
    // Türkçe karakterleri İngilizce karakterlere dönüştürme
    $baslik = str_replace(array('ç', 'ğ', 'ı', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'İ', 'Ö', 'Ş', 'Ü'), array('c', 'g', 'i', 'o', 's', 'u', 'C', 'G', 'I', 'O', 'S', 'U'), $baslik);
 
    // Baştaki ve sondaki boşlukları silme
    $baslik = trim($baslik);
 
    // Birden fazla boşluğu tek boşlukla değiştirme
    $baslik = preg_replace('/\s+/', ' ', $baslik);
 
    // Tüm harfleri küçük harfe çevirme
    $baslik = strtolower($baslik);
 
    // İngilizce karakter ve sayı haricindeki karakterleri "-" ile değiştirme
    $baslik = preg_replace('/[^a-z0-9]+/i', '-', $baslik);
 
    // Başlıkta birden fazla "-" olmasını engelleme
    $baslik = preg_replace('/-+/', '-', $baslik);
 
    return $baslik;
 }
 

?>