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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbs5aH1U6HRc9u6x4n7AwaCJ8GTWp3WMw73uvbLxjJ6B" crossorigin="anonymous">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require_once "navbar.php"; ?>

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
                            <form method="post" action="laporan.php?page=laporan&cari=ok">
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
                                            <!-- <a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
                                                Excel</a> -->
                                            <?php }?>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <form method="post" action="laporan.php?page=laporan&hari=cek">
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
                                            <!-- <a href="excel.php?hari=cek&tgl=<?= $_POST['hari'];?>" class="btn btn-info"><i
                                                    class="fa fa-download"></i>
                                                Excel</a> -->
                                            <?php }else{?>
                                            <!-- <a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
                                                Excel</a> -->
                                            <?php }?>
                                        </td>
                                    </tr>
                                </table>
                                <a href="laporan.php?page=laporan" class="btn btn-success">
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
    </div>

    <!--pagination-->
    <!-- End of Page Wrapper -->

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
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




