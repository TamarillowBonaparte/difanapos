<?php

include "koneksi.php";

//Buat Hapus datanya:
if (isset($_POST['b-ubah'])) {

    $simpan = mysqli_query($koneksi, "UPDATE produk SET 
                                        nama_produk = '$_POST[tproduk]',
                                        merk = '$_POST[tmerk]',
                                        harga_beli = '$_POST[tharga_beli]',
                                        harga_jual = '$_POST[tharga_jual]',
                                        stok = '$_POST[tstok]'
                                        WHERE id_produk = '$_POST[id_produk]'
                                    ");

    if ($simpan) {
        echo "<script>alert ('Data Berhasil Diubah');
        document.location='produk.php';
        
        </script>";
    } else {
        echo "<script>alert ('Data Gagal Diubah!')
        document.location='produk.php';
        </script>";
        $errorMessage = $e->getMessage();
        echo "<script>alert('$errorMessage'); document.location='produk.php';</script>";
        
    }
}
//BUat Hapus
if (isset($_POST['b-hapus'])) {
    $id_produk = $_POST['id_produk'];

    $hapus = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id_produk'");

    if ($hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); document.location='produk.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus!'); document.location='produk.php';</script>";
    }
}

?>
