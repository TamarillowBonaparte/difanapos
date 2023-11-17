<?php
session_start();
require("koneksi.php");

$kode_produk = $_POST['kode_produk'];
$nama_produk = $_POST['nama_produk'];
$merk = $_POST['merk'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$subtotal = $_POST['subtotal'];

// Simpan data ke dalam session keranjang
$_SESSION['keranjang'][] = [
    'kode_produk' => $kode_produk,
    'nama_produk' => $nama_produk,
    'merk' => $merk,
    'harga' => $harga,
    'jumlah' => $jumlah,
    'subtotal' => $subtotal
];
?>
