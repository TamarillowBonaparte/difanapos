<?php
require("koneksi.php");

$kode_produk = $_POST['kode_produk'];

$query_harga = "SELECT harga_jual FROM produk WHERE kode_produk = '$kode_produk'";
$result_harga = mysqli_query($koneksi, $query_harga);
$row_harga = mysqli_fetch_assoc($result_harga);

echo $row_harga['harga_jual'];
mysqli_close($koneksi);
?>
