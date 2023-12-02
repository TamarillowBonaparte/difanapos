<?php

include "koneksi.php";

//Buat Hapus datanya:
if (isset($_POST['b_update'])) {

     $simpan = mysqli_query($koneksi, "UPDATE user SET 
                                        nama_user = '$_POST[tnama]',
                                        username = '$_POST[tuname]',
                                        no_tlp = '$_POST[tnomor]',
                                        email = '$_POST[temail]',
                                        pass = '$_POST[tpass]',
                                        level = '$_POST[tlevel]'
                                   WHERE id_user = '$_POST[iduser]'
                                        ");

     if ($simpan) {
          echo "<script>alert ('Data Berhasil Diubah');
          document.location='tables.php';
     </script>";
     } else {
          echo "<script>alert ('Data Gagal Diubah!')
          document.location='tables.php';
          </script>";
          $errorMessage = $e->getMessage();
          echo "<script>alert('$errorMessage'); document.location='tables.php';</script>";
     }
}
//BUat Hapus
if (isset($_POST['bhapus'])) {
     $id_user = $_POST['id_user'];

     $hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id_user'");

     if ($hapus) {
          echo "<script>alert('Data Berhasil Dihapus'); document.location='tables.php';</script>";
     } else {
          echo "<script>alert('Data Gagal Dihapus!'); document.location='tables.php';</script>";
     }
}
