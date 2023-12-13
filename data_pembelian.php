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
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once "navbar.php "; ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">DATA PEMBELIAN</h1>
                </div>
            </div>

            


<!--Ini Inputtan metod ke database-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $tgl_input = $_POST["tgl_pembelian"];
    $nama_barang = $_POST["nama_barang"];
    //$kode_barang = $_POST["kode_barang"];
    $merk = $_POST["merk"];
    $harga_beli = $_POST["harga_beli"];
    $id_kategori = $_POST["t_kategori"];
    $total_pembayaran = $_POST["total_pembayaran"];
    $stok = $_POST["stok"];
    //$expiry_date = $_POST["expired_date"];
    $id_supplier = $_POST["t_supplier"];
    // var_dump($_POST);

    // Hubungkan ke database 
    $koneksi = new mysqli($server, $username, $password, $db);
    // Cek koneksi
    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    }

    // Mendapatkan ID terbaru dari pembelian
        $result = mysqli_query($koneksi, "SELECT MAX(id_pembelian) as max_id FROM pembelian");
        $row = mysqli_fetch_assoc($result);
        $max_id = $row['max_id'];
        $pembelian_id = ($max_id !== null) ? $max_id + 1 : 1;

        // Menyimpan pembelian ke database
        $sql_pembelian = "INSERT INTO pembelian(id_pembelian, tanggal, total_pembayaran) VALUES ('$pembelian_id', '$tgl_input','$total_pembayaran')";
        if (mysqli_query($koneksi, $sql_pembelian)) {
            
            // Mendapatkan ID terbaru dari detail pembelian
            $result_detail = mysqli_query($koneksi, "SELECT MAX(id_detailpembelian) as max_detail_id FROM detail_pembelian");
            $row_detail = mysqli_fetch_assoc($result_detail);
            $max_detail_id = $row_detail['max_detail_id'];
            $detailpembelian_id = ($max_detail_id !== null) ? $max_detail_id + 1 : 1;

            // Menyimpan detail pembelian ke database
            $sql_detail_pembelian = "INSERT INTO detail_pembelian(id_detailpembelian, id_pembelian, jumlah,merk ,tanggal, nama_produk, harga, id_kategori, id_suplier) 
            VALUES ('$detailpembelian_id','$pembelian_id','$stok','$merk' ,'$tgl_input','$nama_barang','$harga_beli','$id_kategori','$id_supplier')";

            if (mysqli_query($koneksi, $sql_detail_pembelian)) {
                echo '<script>alert("Data berhasil disimpan");</script>';
            } else {
                var_dump("Error: " . $sql_detail_pembelian . "<br>" . mysqli_error($conn));
            }
                
        } else {
            var_dump("Error: " . $sql_pembelian . "<br>" . mysqli_error($conn));
        }
        }
        ?>

<!-- DataTales Example -->
<div class="px-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Pembelian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Nama Produk</td>
                            <td>Harga</td>
                            <td>Jumlah</td>
                            <td>Total Pembayaran</td>
                            <td>Supplier</td> <!-- Changed from 'Suplier' to 'Supplier' -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       $no = 1;
                       $tampil = mysqli_query($koneksi, "SELECT dp.*, p.tanggal_pembelian, p.total_pembayaran, s.nama_supplier, pr.nama_produk, pr.harga_jual
                                                           FROM detail_pembelian dp
                                                           INNER JOIN pembelian p ON dp.id_pembelian = p.id_pembelian
                                                           INNER JOIN produk pr ON dp.id_produk = pr.id_produk
                                                           INNER JOIN supplier s ON pr.id_supplier = s.id_supplier
                                                           ORDER BY p.tanggal_pembelian DESC");
                       
                       if (!$tampil) {
                           die('Query failed: ' . mysqli_error($koneksi));
                       }
                       
                       while ($data = mysqli_fetch_array($tampil)):
                       ?>
                           <tr>
                               <td><?= $no++ ?></td>
                               <td><?= $data['tanggal_pembelian'] ?></td>
                               <td><?= $data['nama_produk'] ?></td>
                               <td><?= $data['harga_jual'] ?></td>
                               <td><?= $data['jumlah'] ?></td>
                               <td><?= $data['total_pembayaran'] ?></td>
                               <td><?= $data['nama_supplier'] ?></td>
                           </tr>
                       <?php endwhile; ?>
                                    
                           
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
                                                    <label class="form-label">STOK</label>
                                                    <input type="text" class="form-control" name="tstok" value="<?= $data['stok'] ?>">
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
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script>
    function calculateTotal() {
        // Get the values of Harga Beli and Stok
        var hargaBeli = document.getElementById("harga_beli").value;
        var stok = document.getElementById("stok").value;

        // Check if both values are numbers
        if (!isNaN(hargaBeli) && !isNaN(stok)) {
            // Calculate the total payment
            var totalPayment = parseFloat(hargaBeli) * parseFloat(stok);

            // Display the total payment in the "Total Pembayaran" input field
            document.getElementById("total_pembayaran").value = totalPayment.toFixed(2);
        }
    }
    </script>
  <!-- Bootstrap core JavaScript-->

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
    <!-- DataTables script -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables initialization script -->
<script src="js/demo/datatables-simple-demo.js"></script>


</body>
</html>