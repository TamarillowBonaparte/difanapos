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


$bulan_tes =array(
    '01'=>"Januari",
    '02'=>"Februari",
    '03'=>"Maret",
    '04'=>"April",
    '05'=>"Mei",
    '06'=>"Juni",
    '07'=>"Juli",
    '08'=>"Agustus",
    '09'=>"September",
    '10'=>"Oktober",
    '11'=>"November",
    '12'=>"Desember"
);
    
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

            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

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

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">LAPORAN</h1>
                    </div>
                </div>


<!-- Tombol Cari -->
<div class="col mb-3 px-4">
                    <div class="card">
                        <div class="card-body py-4">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                        <div class="card-header">
                                            <h5 class="card-title mt-2">Cari Laporan Per Bulan</h5>
                                        </div>
                                       
                                            <form method="post" action="data-transaksi.php?page=laporan&cari=ok">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th>
                                                            Pilih Bulan
                                                        </th>
                                                        <th>
                                                            Pilih Tahun
                                                        </th>
                                                        <th>
                                                            Aksi
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select name="bln" class="form-control">
                                                                <option selected="selected">Bulan</option>
                                                                <?php
                                                                $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                                                $jlh_bln=count($bulan);
                                                                $bln1 = array('01','02','03','04','05','06','07','08','09','10','11','12');
                                                                $no=1;
                                                                for($c=0; $c<$jlh_bln; $c+=1){
                                                                    echo"<option value='$bln1[$c]'> $bulan[$c] </option>";
                                                                $no++;}
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                        <?php

                                                        $now=date('Y');
                                                        echo "<select name='thn' class='form-control'>";
                                                        echo '
                                                        <option selected="selected">Tahun</option>';
                                                        for ($a=2017;$a<=$now;$a++)
                                                        {
                                                            echo "<option value='$a'>$a</option>";
                                                        }
                                                        echo "</select>";

                                                        ?>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="periode" value="ya">
                                                            <button class="btn btn-primary">
                                                                <i class="fa fa-search"></i> Cari
                                                            </button>
                                                            
                                                            <?php if(!empty($_GET['cari'])){?>
                                                            <a href="excel.php?cari=yes&bln=<?=$_POST['bln'];?>&thn=<?=$_POST['thn'];?>"
                                                                class="btn btn-info"><i class="fa fa-download"></i>
                                                                Excel</a>
                                                            <?php }else{?>
                                                            <a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
                                                                Excel</a>
                                                            <?php }?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                            <form method="post" action="data-transaksi.php?page=laporan&hari=cek">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th>
                                                            Pilih Hari
                                                        </th>
                                                        <th>
                                                            Aksi
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="date" value="<?= date('Y-m-d');?>" class="form-control" name="hari">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="periode" value="ya">
                                                            <button class="btn btn-primary">
                                                                <i class="fa fa-search"></i> Cari
                                                            </button>

                                                            <?php if(!empty($_GET['hari'])){?>
                                                            <a href="excel.php?hari=cek&tgl=<?= $_POST['hari'];?>" class="btn btn-info"><i
                                                                    class="fa fa-download"></i>
                                                                Excel</a>
                                                            <?php }else{?>
                                                            <a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
                                                                Excel</a>
                                                            <?php }?>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <a href="data-transaksi.php?page=laporan" class="btn btn-success">
                                                    <i class="fa fa-refresh"></i> Refresh
                                                </a>
                                            </form>
                                <!--End Pencarian -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Tabel --> 
                <div class="col mb-3 px-4">
                    <div class="card mb-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td>ID Penjualan</td>
                                            <td>Tanggal</td>
                                            <td>Total</td>
                                            <td>Kasir</td>
                                            <td>Nota</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        if (isset($_GET['cari']) && $_GET['cari'] == 'ok') {
                                            $bulan = $_POST['bln'];
                                            $tahun = $_POST['thn'];

                                            $tampil = mysqli_query($koneksi, "SELECT penjualan.id_penjualan, penjualan.tgl_penjualan, penjualan.total, user.username 
                                                                                FROM penjualan 
                                                                                JOIN user ON penjualan.id_user = user.id_user 
                                                                                WHERE MONTH(penjualan.tgl_penjualan) = '$bulan' AND YEAR(penjualan.tgl_penjualan) = '$tahun'
                                                                                ORDER BY penjualan.tgl_penjualan DESC");
                                        } elseif (isset($_GET['hari']) && $_GET['hari'] == 'cek') {
                                            $tanggal = $_POST['hari'];

                                            $tampil = mysqli_query($koneksi, "SELECT penjualan.id_penjualan, penjualan.tgl_penjualan, penjualan.total, user.username 
                                                                                FROM penjualan 
                                                                                JOIN user ON penjualan.id_user = user.id_user 
                                                                                WHERE DATE(penjualan.tgl_penjualan) = '$tanggal'
                                                                                ORDER BY penjualan.tgl_penjualan DESC");
                                        } else {
                                            $tampil = mysqli_query($koneksi, "SELECT penjualan.id_penjualan, penjualan.tgl_penjualan, penjualan.total, user.username 
                                                                                FROM penjualan 
                                                                                JOIN user ON penjualan.id_user = user.id_user 
                                                                                ORDER BY penjualan.tgl_penjualan DESC");
                                        }

                                    $no = 1;
                                    while ($data = mysqli_fetch_array($tampil)):

                                    ?>
                                    <tr>
                                        <td><?= $data['id_penjualan'] ?></td>
                                        <td><?= $data['tgl_penjualan'] ?></td>
                                        <td><a>Rp.</a><?= $data['total'] ?></td>
                                        <td><?= $data['username'] ?></td>
                                        <td>
                                        <a href="lihatnota.php?id=<?= $data['id_penjualan'] ?>" class="btn btn-primary" target="_blank">Lihat</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                    endwhile;

                                    ?>
                                    </tbody>
                                </table>
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




