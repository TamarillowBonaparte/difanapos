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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
            <div class="sidebar-brand-icon ">
                <!-- Menambahkan gaya CSS untuk mengontrol ukuran gambar -->
                <img src="logo atas.png" alt="Logo" style="max-width: 65px; max-height: 65px;">
            </div>
            <div class="sidebar-brand-text mx-3">SIDINAF</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard </span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-book"></i>
                    <span>Produk</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Fitur Data Produk :</h6>
                        <a class="collapse-item" href="produk.php">Data Produk</a>
                        <a class="collapse-item" href="data_pembelian.php">Data Pembelian</a>
                        <a class="collapse-item" href="kategori.php">Kategori</a>
                        <!-- <a class="collapse-item" href="cards.html">Data Produk Return</a> -->
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="kasir.php">
                    <i class="fa-solid fa-cash-register"></i>
                    <span>Kasir</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="laporan.php">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                    <span>Laporan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <span>Manajemen Karyawan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.php">Login</a>
                        <a class="collapse-item" href="register.php">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Charts -->

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#"></a>
                            </div>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php
                        
                                if (isset($_SESSION['username'])) {
                                    echo $_SESSION['username'];
                                } else {
                                    echo 'DefaultUsername'; // Provide a default if the session variable is not set
                                }
                                ?>
                            </span>
                            <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                        </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">DATA KATEGORI & SUPLIER</h1>
                    </div>
                </div>


<div class="px-3">
<!-- Inputan Barang 1-->
<div class="row">
    <div class="col-6 mb-3">
        <div class="card" >
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Input Suplier Baru</h6>
            </div>
                <div class="card-body py-4">
                    <form method="POST">
                        <div class="form-group row mb-0">
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Suplier :</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="text" class="form-control form-control-sm" name="nama_suplier">
                        </div>
                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Alamat :</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="text" class="form-control form-control-sm" name="alamat">
                        </div>
                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nomer Telpon :</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="text" class="form-control form-control-sm" name="no_telp">
                        </div>
                        <div class="container d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary" name="tambahsup">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Inputan Barang 1-->

    <!-- Inputan Barang 2-->
    <div class="col-6 mb-3">
        <div class="card" >
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Input Kategori Baru</h6>
            </div>
                <div class="card-body py-4">
                    <form method="POST">
                        <div class="form-group row mb-0">
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Kategori :</b></label>
                        <div class="col-sm-8 mb-2">
                            <input type="text" class="form-control form-control-sm" name="nama_kategori">
                        </div>
                        <div class="container d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary" name="tambahkategori">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Inputan Barang 2 -->


<?php

$servername = "localhost";  // Ganti dengan nama server database Anda
$username = "root";    // Ganti dengan nama pengguna database Anda
$password = "";    // Ganti dengan kata sandi database Anda
$dbname = "toko"; // Ganti dengan nama database Anda

$koneksi = new mysqli($servername, $username, $password, $dbname);
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


    $koneksi = new mysqli($servername, $username, $password, $dbname);


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

            <!-- DataTales Example -->
            <div class="row">
                <div class="col-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Suplier</h6>
                        </div>
                        <div class="card-body">
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
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id_supplier DESC"); while ($data = mysqli_fetch_array($tampil)):
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
                                                        <h5 class="modal-title" id="staticBackdropLabel">UBAH</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="aksi_crud.php">
                                                            <input type="hidden" name= "id_produk" value= "<?= $data['id_produk']?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Produk</label>
                                                                <input type="text" class="form-control" name="tproduk" value="<?= $data['nama_produk'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Merk</label>
                                                                <input type="text" class="form-control" name="tmerk" value="<?= $data['merk'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Harga Beli</label>
                                                                <input type="text" class="form-control" name="tharga_beli" value="<?= $data['harga_beli'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Harga Jual</label>
                                                                <input type="text" class="form-control" name="tharga_jual" value="<?= $data['harga_jual'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">no_telp</label>
                                                                <input type="text" class="form-control" name="tno_telp" value="<?= $data['no_telp'] ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary" name="b-ubah">Update</button>
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
                                                            <input type="hidden" name= "id_produk" value= "<?= $data['id_produk']?>">
                                                            <h5 class="text-center">Apakah anda ingin menghappus produk ini? <br>
                                                                <span class="text-danger"><?= $data['nama_produk']?></span>
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
                <!--Tabel Kedua-->
                <div class="col-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Suplier</h6>
                        </div>
                        <div class="card-body">
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
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id_supplier DESC"); while ($data = mysqli_fetch_array($tampil)):
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
                                                        <h5 class="modal-title" id="staticBackdropLabel">UBAH</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="aksi_crud.php">
                                                            <input type="hidden" name= "id_produk" value= "<?= $data['id_produk']?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Produk</label>
                                                                <input type="text" class="form-control" name="tproduk" value="<?= $data['nama_produk'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Merk</label>
                                                                <input type="text" class="form-control" name="tmerk" value="<?= $data['merk'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Harga Beli</label>
                                                                <input type="text" class="form-control" name="tharga_beli" value="<?= $data['harga_beli'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Harga Jual</label>
                                                                <input type="text" class="form-control" name="tharga_jual" value="<?= $data['harga_jual'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">no_telp</label>
                                                                <input type="text" class="form-control" name="tno_telp" value="<?= $data['no_telp'] ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary" name="b-ubah">Update</button>
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
                                                            <input type="hidden" name= "id_produk" value= "<?= $data['id_produk']?>">
                                                            <h5 class="text-center">Apakah anda ingin menghappus produk ini? <br>
                                                                <span class="text-danger"><?= $data['nama_produk']?></span>
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
                <script src="vendor/jquery/jquery.min.js"></script>
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