<?php

require("koneksi.php");

session_start();

if (!isset($_SESSION['id_user'])) {

    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}

$sesID = $_SESSION['id_user'];
$sesName = $_SESSION['username'];
$sesLvl = $_SESSION['level'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id_user = $_POST["id_user"];
    $nama = $_POST["nama"];
    $username2 = $_POST["username"];
    $nmr = $_POST["nomer"];
    $email = $_POST["email"];
    $pw = $_POST["password"];
    $level = $_POST["level"];

  

    $conn = new mysqli($server, $username, $password, $db);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query SQL untuk memasukkan data ke dalam database
    $sql = "INSERT INTO `user`(`id_user`, `nama_user`, `username`, `no_tlp`, `email`, `pass`, `level`) VALUES ('$id_user','$nama','$username2','$nmr','$email','$pw','$level')";
    if ($conn->query($sql) === TRUE) {
        //echo "Data berhasil ditambahkan!";
        echo "<script>alert('Menu berhasil ditambahkan');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi ke database
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SIDINAF</title>
    <link rel="icon" href="logo atas.png" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once "navbar.php "; ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">MANAJEMEN KARYAWAN</h1>
                </div>
            </div>

               <!-- Inputan Barang -->
        <div class="col mb-3 py-3">
            <div class="card" style="width: 70rem;">
            <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group row mb-0">
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Email :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="input_email">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Password :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="kode_barang">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Username :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="merk">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm" ><b>Nomer Telpon :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="harga_beli">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Level :</b></label>
                            <div class="col-sm-8 mb-2">
                            <select class="form-select" name="t-kategori">
                                <option selected disabled>Pilih Level User</option>
                                <option value="1">Admin</option>
                                <option value="2">Kasir</option>
                            </select>
                            </div>
                                <div class="container d-flex justify-content-end align-items-center">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End Inputan Barang -->

         <!-- DataTales Semua User -->
         <div class="px-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Produk Keluar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Catatan</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>

                        <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM produkkeluar ORDER BY id_produkkeluar ASC");
                            while ($data = mysqli_fetch_array($tampil)) :
                        ?>
                            <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['id_produk'] ?></td>
                                    <td><?= $data['jumlah'] ?></td>
                                    <td><?= $data['catatan'] ?></td>
                                    <td><?= $data['tanggal'] == 1 ? 'Admin' : 'Karyawan' ?></td>
                                <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUbahUser<?= $no ?>">Ubah</a>
                                <a href="#" class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                                </td>
                            </tr>
        
                            <!-- Modal Ubah-->
                            <div class="modal fade" id="modalUbahUser<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">UBAH</h5>
                                    <button class="btn-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="aksi_crud.php">
                                        <input type="hidden" name= "id_user" value= "<?= $data['id_user'] ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="t_username" value="<?= $data['username'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="t_email" value="<?= $data['email'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="text" class="form-control" name="t_password" value="<?= $data['password'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">level</label>
                                        <input type="text" class="form-control" name="t_level" value="<?= $data['level'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomer Telpon</label>
                                        <input type="text" class="form-control" name="t_nomertelp" value="<?= $data['nomer-telp'] ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="UbahUser">Update</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!--End OF Tabel user-->

                            

                            <!-- Modal Hapus-->
                            <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">HAPUS</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="aksi_crud.php">
                                        <input type="hidden" name= "id_produk" value= "<?= $data['id_produk'] ?>">

                                        <h5 class="text-center">Apakah anda ingin menghappus produk ini? <br>
                                                        <span class="text-danger"><?= $data['nama_produk'] ?></span>
                                        </h5>
                                    <button type="submit" class="btn btn-danger" name="b-hapus">Hapus</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>                         
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- DataTales Semua User -->
    <div class="px-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Produk Keluar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Catatan</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>

                        <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM produkkeluar ORDER BY id_produkkeluar ASC");
                            while ($data = mysqli_fetch_array($tampil)) :
                        ?>
                            <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['id_produk'] ?></td>
                                    <td><?= $data['jumlah'] ?></td>
                                    <td><?= $data['catatan'] ?></td>
                                    <td><?= $data['tanggal'] == 1 ? 'Admin' : 'Karyawan' ?></td>
                                <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUbahUser<?= $no ?>">Ubah</a>
                                <a href="#" class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                                </td>
                            </tr>
        
                            <!-- Modal Ubah-->
                            <div class="modal fade" id="modalUbahUser<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">UBAH</h5>
                                    <button class="btn-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="aksi_crud.php">
                                        <input type="hidden" name= "id_user" value= "<?= $data['id_user'] ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="t_username" value="<?= $data['username'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="t_email" value="<?= $data['email'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="text" class="form-control" name="t_password" value="<?= $data['password'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">level</label>
                                        <input type="text" class="form-control" name="t_level" value="<?= $data['level'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomer Telpon</label>
                                        <input type="text" class="form-control" name="t_nomertelp" value="<?= $data['nomer-telp'] ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="UbahUser">Update</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            
                            <!-- Modal Hapus-->
                            <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">HAPUS</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="aksi_crud.php">
                                                                    <input type="hidden" name= "id_produk" value= "<?= $data['id_produk'] ?>">

                                                                    <h5 class="text-center">Apakah anda ingin menghappus produk ini? <br>
                                                                                    <span class="text-danger"><?= $data['nama_produk'] ?></span>
                                                                    </h5>
                                                                <button type="submit" class="btn btn-danger" name="b-hapus">Hapus</button>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>                         
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>