<?php 
    date_default_timezone_set('Asia/Jakarta');
    require_once "koneksi.php";

    session_start();
    $sesID = $_SESSION['id_user'];
    $tanggalRiwayat = date("Y-m-d H:i:s");
    $inputlogout = mysqli_query($koneksi, "INSERT INTO riwayatlogout VALUES ('', '$sesID', '$tanggalRiwayat')");

    if (session_destroy()) {
        
        header("Location: index.php");
    }

?>