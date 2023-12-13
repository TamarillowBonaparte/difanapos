<?php
$server   = "localhost";
$username = "root";
$password = "";
$db       = "toko";
$koneksi = mysqli_connect($server, $username, $password, $db);
//pastikan variablenya sama

//untuk cek jika koneksi gagal ke database
if(mysqli_connect_errno()){
    echo "koneksi   gagal : ".mysqli_connect_error();
}
?>