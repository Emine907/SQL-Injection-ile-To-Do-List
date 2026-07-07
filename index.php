<?php
include 'index.html';
?>

<?php
//500 hatası yerine hatanın ismini vermesi için 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php'; //db.php buraya bağlanıyor.
//Formdan veri gelirse veritabanına eklemek için 
if(isset($_POST['gorev']) && !empty($_POST['gorev'])) {
        $yeni_gorev = $_POST['gorev'];
        //SQL Injection açığı burada: veri olduğu gibi sorguya gidiyor.
        $sorgu = "INSERT INTO gorevler (gorev) VALUES ('$yeni_gorev') ";
        //Başlangıçta burada mysqli_query kullanmıştım ama bu tek seferde tek sorgu çalıştıdığı için tek seferde daha fazla sorgu çalıştırabilmek için mysqli_multi_query kullanmaya başladım.
        mysqli_multi_query($baglan, $sorgu);
        header("Location: https://to-do-list-sqlinjection.kesug.com/");
        exit;
}
if(isset($_GET['sil'])) {
        $silinecek_id = (int) $_GET['sil'];
        mysqli_query($baglan, "DELETE FROM gorevler WHERE id = $silinecek_id");
        header("Location: https://to-do-list-sqlinjection.kesug.com/");
        exit;
}
//Görevleri listele
$ara = isset($_GET['ara']) ? $_GET['ara'] : "";
if($ara == "") {
        $liste_sorgu = "SELECT * FROM gorevler ";
} else {
        $liste_sorgu = "SELECT * FROM gorevler WHERE gorev = '$ara' ";
}
$liste = mysqli_multi_query($baglan, $liste_sorgu);
$liste = mysqli_store_result($baglan);
if($liste) {
        while ($satir = mysqli_fetch_assoc($liste)) {
                echo "<li>" . $satir['gorev'] . " <a href='? sil=" . $satir['id'] . " '>[Sil]</a></li>";
        }
}
?>
