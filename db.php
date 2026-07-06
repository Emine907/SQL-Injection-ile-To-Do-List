<?php
$sunucu = "sql301.infinityfree.com ";
$kullanici = "f0_42348949";
$sifre = "69738565";
$veritabani = "todo_db";

//Veritabanı bağlantısı
$baglan = mysqli_connect($sunucu, $kullanici, $sifre, $veritabani);

//Bağlantı hatası kontrolü
if (!$baglan) {
        die("Bağlantı başarısız: " . mysqli_connect_error());
}
?>
