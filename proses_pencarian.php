<?php
require("koneksi.php");

$koneksi = mysqli_connect($server, $username, $password, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil nilai pencarian dari parameter GET
$cari = $_GET['cari'];

// Query pencarian ke database (sesuaikan dengan struktur tabel Anda)
$query = "SELECT * FROM produk WHERE nama_produk LIKE '%$cari%' OR kode_produk LIKE '%$cari%'";
$resultcari = mysqli_query($koneksi, $query);

// Check for query execution errors
if (!$resultcari) {
    die("Query failed: " . mysqli_error($koneksi));
}

// Tampilkan hasil pencarian
echo "<table style='border-collapse: collapse; width: 100%;'>";
while ($row = mysqli_fetch_assoc($resultcari)) {
    echo "<tr style='border-bottom: 1px solid #000;'>";
    echo "<td style='padding: 5px;'><strong>Kode Barang9</strong><br> " . $row['id_produk'] . "</td>";
    echo "<td style='padding: 5px;'><strong>Harga_Jual</strong><br> " . $row['harga_jual'] . "</td>";
    echo "<td style='padding: 5px;'><strong>Nama Barang</strong><br>" . $row['nama_produk'] . "</td>";
    echo "<td style='padding: 5 px;'><strong>merk</strong><br>" . $row['merk'] . "</td>";

    // Tambahkan tombol pada setiap baris dengan aksi JavaScript
    echo "<td style='padding: 5px;'><button class='btn btn-primary' onclick='pilihBarang(\"" . $row['id_produk'] . "\", \"" . $row['nama_produk'] . "\", \"" . $row['harga_jual'] . "\", \"" . $row['harga_jual'] . "\")'>Pilih</button></td>";

    echo "</tr>";
}
echo "</table>";

// Tutup koneksi ke database
mysqli_close($koneksi);
?>


