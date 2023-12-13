<?php
include "koneksi.php";
session_start();
$sesID = $_SESSION['id_user'];

// Buat Ubah data datanya:
if (isset($_POST['b-ubah'])) {
    // Mengambil data produk
    $ambilStok = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$_POST[id_produk]'");
    $row = $ambilStok->fetch_assoc();
    $tambahStok = $row['stok'] + $_POST['tambahstok'];
    $totalpembayaran = $row['harga_beli'] * $_POST['tambahstok'];

    // Mengupdate data produk
    $simpanProduk = mysqli_query($koneksi, "UPDATE produk SET 
                                        nama_produk = '$_POST[tproduk]',
                                        merk = '$_POST[tmerk]',
                                        harga_beli = '$_POST[tharga_beli]',
                                        harga_jual = '$_POST[tharga_jual]',
                                        stok = '$tambahStok'
                                        WHERE id_produk = '$_POST[id_produk]'
                                    ");

    if ($simpanProduk) {

        if ($_POST['tambahstok'] > 0) {
            // Query untuk insert ke tabel pembelian
            $tanggalPembelian = date("Y-m-d");
            $insertPembelian = mysqli_query($koneksi, "INSERT INTO pembelian (tanggal_pembelian, total_pembayaran, id_user) 
                                                VALUES ('$tanggalPembelian', '$totalpembayaran','$sesID')");

            // Get the last inserted ID in the pembelian table
            $pembelian_id = mysqli_insert_id($koneksi);

            // Insert into detail_pembelian using the same $pembelian_id
            $insertDetail = mysqli_query($koneksi, "INSERT INTO detail_pembelian (id_pembelian, id_produk, jumlah, subTotal) 
             VALUES ('$pembelian_id', '$_POST[id_produk]', '$_POST[tambahstok]',  '$totalpembayaran')");

            if ($insertDetail) {
                echo "<script>alert('Data Berhasil Diubah dan Ditambahkan ke Pembelian');
                    document.location='produk.php';
                </script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($koneksi) . "');
                    document.location='';
                </script>";
            }
            
        }
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

//Buat Simpan Data Supplier
if (isset($_POST['b-sup'])) {
   $simpan = mysqli_query($koneksi, "INSERT INTO supplier (nama_supplier,alamat,no_telp)
                                      VALUES ('$_POST[namasup]','$_POST[alamat]','$_POST[no_telp]') ");
    if ($simpan) {
        echo "<script>alert('Data Berhasil Ditambah'); document.location='kategori.php';</script>";
    } else {
        echo 
        $errorMessage = $e->getMessage();
        echo "<script>alert('$errorMessage'); document.location='kategori.php';</script>";
    }
}

//Buat Ubah Supplier :
if (isset($_POST['ubahsupplier'])) {
    try {
        $simpan = mysqli_query($koneksi, "UPDATE supplier SET 
                                            nama_supplier = '$_POST[tsupplier]',
                                            alamat = '$_POST[talamat]',
                                            no_telp = '$_POST[tnotelp]'
                                            WHERE id_supplier = '$_POST[id_supplier]'
                                        ");
        if ($simpan) {
            echo "<script>alert('Data Berhasil Diubah'); document.location='kategori.php';</script>";
        } else {
            throw new Exception("Error in updating data.");
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
        echo "<script>alert('$errorMessage'); document.location='kategori.php';</script>";
    }
}

//BUat Hapus Supplier
if (isset($_POST['supplier-hapus'])) {
    $id_supplier = $_POST['id_supplier'];

    $hapussupplier = mysqli_query($koneksi, "DELETE FROM supplier WHERE id_supplier = '$id_supplier'");

    if ($hapussupplier) {
        echo "<script>alert('Data Berhasil Dihapus'); document.location='kategori.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus!'); document.location='kategori.php';</script>";
    }
}

//Buat Tambah Kategori
if (isset($_POST['b-kategori'])) {
    try {
        $simpankategori = mysqli_query($koneksi, "INSERT INTO kategori(nama_kategori) VALUES ('$_POST[namakategori]')");
        if ($simpankategori) {
            echo "<script>alert('Data Berhasil Ditambah'); document.location='kategori.php';</script>";
        } else {
            throw new Exception("Gagal menyimpan data kategori");
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
        echo "<script>alert('$errorMessage'); document.location='kategori.php';</script>";
    }
}

 

//Buat Ubah Kategori :
if (isset($_POST['ubahkategori'])) {
    try {
        $simpankategori = mysqli_query($koneksi, "UPDATE kategori SET 
                                            nama_kategori = '$_POST[tkategori]'
                                            WHERE id_kategori = '$_POST[id_kategori]'
                                        ");
        if ($simpankategori) {
            echo "<script>alert('Data Berhasil Diubah'); document.location='kategori.php';</script>";
        } else {
            throw new Exception("Error in updating data.");
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
        echo "<script>alert('$errorMessage');</script>";
        var_dump($simpankategori);
    }
}


//BUat Hapus Kategori
if (isset($_POST['kategori-hapus'])) {
    $id_kategori = $_POST['id_kategori'];

    $hapuskategori = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id_kategori'");

    if ($hapuskategori) {
        echo "<script>alert('Data Berhasil Dihapus'); document.location='kategori.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus!'); document.location='kategori.php';</script>";
    }
 
}

//buat ubah user
if (isset($_GET['action']) && $_GET['action'] === 'update') {
    // Include any necessary validation/sanitization functions
    // require_once "validation_functions.php";

    // Retrieve the form data
    $id_user = $_POST['id_user'];
    $t_username = $_POST['t_username'];
    $t_email = $_POST['t_email'];
    $t_password = $_POST['t_password'];
    $t_level = $_POST['t_level'];
    $t_nomertelp = $_POST['t_nomertelp'];


    $sql = "UPDATE user SET username='$t_username', email='$t_email', password='$t_password', level='$t_level', nomer_telp='$t_nomertelp' WHERE id_user='$id_user'";
    $result = mysqli_query($connection, $sql);


    if ($result) {
        // Redirect to the appropriate page with a success message
        header("Location: tables.php?success=1");
        exit();
    } else {
        // Redirect to the appropriate page with an error message
        header("Location: tables.php?error=1");
        exit();
    }
}


//BUat Hapus Kategori
if (isset($_POST['kategori-hapus'])) {
    $id_kategori = $_POST['id_kategori'];

    $hapuskategori = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id_kategori'");

    if ($hapuskategori) {
        echo "<script>alert('Data Berhasil Dihapus'); document.location='kategori.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus!'); document.location='kategori.php';</script>";
    }
 
}


?>

