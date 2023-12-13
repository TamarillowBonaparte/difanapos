<?php

require ("koneksi.php");

session_start();

if(!isset($_SESSION['id_user'])){
    
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}

    $sesID = $_SESSION ['id_user'];
    $sesName = $_SESSION ['username'];
    $sesLvl = $_SESSION [ 'level'];
    
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbs5aH1U6HRc9u6x4n7AwaCJ8GTWp3WMw73uvbLxjJ6B" crossorigin="anonymous">


</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php require_once "navbar.php "; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">DATA KATEGORI & SUPLIER</h1>
                    </div>
                </div>



<?php

$koneksi = new mysqli($server, $username, $password, $db);
$result = mysqli_query($koneksi, "SELECT MAX(id_supplier) as max_id FROM supplier");
$row = mysqli_fetch_assoc($result);
$max_id = $row['max_id'];
$supplier_id = ($max_id !== null) ? $max_id + 1 : 1;

//ini buat input kategorinya aja
if (isset($_POST['tambahsup'])) {
    $nama_suplier = $_POST["nama_suplier"];
    $alamat = $_POST["alamat"];
    $no_telp = $_POST["no_telp"];

    // Query SQL untuk memasukkan data ke dalam database
    $sql = "INSERT INTO supplier (id_supplier, nama_supplier, alamat, no_telp)
            VALUES ('$supplier_id', '$nama_suplier', '$alamat', '$no_telp')";

    if ($koneksi->query($sql) === TRUE) {
        //echo "Data berhasil ditambahkan!";
        echo "<script>alert('Menu berhasil ditambahkan');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    // Tutup koneksi ke database
    $koneksi->close();
}

if (isset ($_POST['tambahkategori'])) {

    $nama_kategori = $_POST["nama_kategori"];
    $tgl_input = $_POST["tgl_input"];

    // Ambil nilai dari form supplier
    $nama_kategori = $_POST["nama_kategori"];
    $tgl_input = $_POST["tgl_input"];


    $koneksi = new mysqli($server, $username, $password, $db);


    // Query SQL untuk memasukkan data ke dalam database
    $sql = "INSERT INTO kategori (nama_kategori)
            VALUES ('$nama_kategori')";

    if ($koneksi->query($sql) === TRUE) {
        //echo "Data berhasil ditambahkan!";
        echo "<script>alert('Menu berhasil ditambahkan');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        
    }

    // Tutup koneksi ke database
    $koneksi->close();
}
?>

            <!-- DataTales Supplier -->
            <div class="row px-3">
                <div class="col-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Suplier</h6>
                        </div>
                        <div class="card-body">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Tambah Supplier
                                </button>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Supplier</th>
                                            <th>Alamat</th>
                                            <th>No Telpon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id_supplier ASC"); while ($data = mysqli_fetch_array($tampil)):
                                        ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data ['nama_supplier'] ?></td>
                                            <td><?= $data ['alamat'] ?></td>
                                            <td><?= $data['no_telp'] ?></td>
                                            <td>
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no ?>">Ubah</a>
                                            <a href="#" class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                                            </td>
                                        </tr>
                
                                        <!-- Modal Ubah-->
                                        <div class="modal fade" id="modalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Supplier</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="aksi_crud.php">
                                                            <input type="hidden" name= "id_supplier" value= "<?= $data['id_supplier']?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Supplier :</label>
                                                                <input type="text" class="form-control" name="tsupplier" value="<?= $data['nama_supplier'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Alamat :</label>
                                                                <input type="text" class="form-control" name="talamat" value="<?= $data['alamat'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nomer Telp :</label>
                                                                <input type="text" class="form-control" name="tnotelp" value="<?= $data['no_telp'] ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary" name="ubahsupplier">Update Data</button>
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
                                                            <input type="hidden" name= "id_supplier" value= "<?= $data['id_supplier']?>">
                                                            <h5 class="text-center">Apakah anda ingin menghappus produk ini? <br>
                                                                <span class="text-danger"><?= $data['nama_supplier']?></span>
                                                            </h5>                                            
                                                            <button type="submit" class="btn btn-danger" name="supplier-hapus">Hapus</button>
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

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Supplier</h5>
                                    <span class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-circle-xmark fa-2xl" style="color: #046df6;"></i></span>

                            </div>
                            <div class="modal-body">
                                <form method="POST" action="aksi_crud.php">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Supplier :</label>
                                        <input type="text" class="form-control" name="namasup" id="exampleFormControlInput1" placeholder="Masukkan Nama Supplier">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Alamat :</label>
                                        <input type="text" class="form-control" name="alamat" id="exampleFormControlInput1" placeholder="Masukkan Alamat Supplier">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nomer Telpon :</label>
                                        <input type="text" class="form-control" name="no_telp" id="exampleFormControlInput1" placeholder="Masukkan Nomer Telpon">
                                    </div>
                                
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="b-sup" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--Tabel Kategori-->
                <div class="col-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
                        </div>
                        <div class="card-body">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                                Tambah Kategori
                                </button>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori ASC"); while ($data = mysqli_fetch_array($tampil)):
                                        ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data ['nama_kategori'] ?></td>
                                            <td>
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUbahKategori<?= $no ?>">Ubah</a>
                                            <a href="#" class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#modalHapusKategori<?= $no ?>">Hapus</a>
                                            </td>
                                        </tr>
                
                                        <!-- Modal Ubah-->
                                        <div class="modal fade" id="modalUbahKategori<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Supplier</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="aksi_crud.php">
                                                            <input type="hidden" name= "id_kategori" value= "<?= $data['id_kategori']?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Kategori :</label>
                                                                <input type="text" class="form-control" name="tkategori" value="<?= $data['nama_kategori'] ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary" name="ubahkategori">Update Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="modalHapusKategori<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="aksi_crud.php">
                                                            <input type="hidden" name= "id_kategori" value= "<?= $data['id_kategori']?>">
                                                            <h5 class="text-center">Apakah anda ingin menghappus produk ini? <br>
                                                                <span class="text-danger"><?= $data['nama_kategori']?></span>
                                                            </h5>                                            
                                                            <button type="submit" class="btn btn-danger" name="kategori-hapus">Hapus</button>
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

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="modalTambahKategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                                    <span class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-circle-xmark fa-2xl" style="color: #046df6;"></i></span>

                            </div>
                            <div class="modal-body">
                                <form method="POST" action="aksi_crud.php">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Kategorri :</label>
                                        <input type="text" class="form-control" name="namakategori" id="exampleFormControlInput1" placeholder="Masukkan Nama Kategorir">
                                    </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="b-kategori" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>



            <!--pagination-->
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>
                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="tr+ue">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end
                                your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="proses_login.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap core JavaScript-->
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="js/datatables-simple-demo.js"></script>


                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/chart-area-demo.js"></script>
                <script src="js/demo/chart-pie-demo.js"></script>
                <script src="js/demo/datatables-simple-demo.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    
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

</body>
</html>