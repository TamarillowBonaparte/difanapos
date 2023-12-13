<?php
require ('koneksi.php');
session_start();

if (!isset($_SESSION['id_user'])) {
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}

$sesID = $_SESSION['id_user'];
$sesName = $_SESSION['username'];
$sesLvl = $_SESSION['level'];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbs5aH1U6HRc9u6x4n7AwaCJ8GTWp3WMw73uvbLxjJ6B" crossorigin="anonymous">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once 'navbar.php'; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">DATA PRODUK</h1> 
            </div>
        </div>

        <!-- Inputan Barang -->
        <div class="col mb-3 py-3">
            <div class="card" style="width: 70rem;">
            <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambahkan Produk Baru</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group row mb-0">
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tanggal Inputtan Produk :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="tgl_input" value="<?php echo date('Y-m-d'); ?>" readonly>
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Supplier :</b></label>
                            <div class="col-sm-8 mb-2">
                                <select class="form-select" name="t-supplier">
                                    <option selected disabled>Pilih Supplier</option>
                                    <?php
                                        // Kode untuk mengambil data supplier dari database
                                        $koneksi = mysqli_connect($server, $username, $password, $db);
                                        // Query untuk mengambil data supplier
                                        $query = 'SELECT id_supplier, nama_supplier FROM supplier';
                                        $result = mysqli_query($koneksi, $query);

                                        // Loop untuk membangun opsi dari hasil query
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $row['id_supplier'] . "'>" . $row['nama_supplier'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Produk :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="nama_barang">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kode Produk :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="kode_barang">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Merk :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="merk">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Harga Beli :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="harga_beli">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Harga Jual :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="harga_jual">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Stok :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="stok">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Expired Date :</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="date" class="form-control form-control-sm" name="expired_date" value="<?= date('Y-m-d'); ?>">
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kategori :</b></label>
                            <div class="col-sm-8 mb-2">
                            <select class="form-select" name="t-kategori">
                                <option selected disabled>Pilih Kategori</option>
                                <?php
                                    // Kode untuk mengambil data supplier dari database
                                    $koneksi = mysqli_connect($server, $username, $password, $db);
                                    // Query untuk mengambil data supplier
                                    $query = 'SELECT id_kategori, nama_kategori FROM kategori';
                                    $result = mysqli_query($koneksi, $query);

                                    // Loop untuk membangun opsi dari hasil query
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . '</option>';
                                    }
                                ?>
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

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil nilai dari form
            $tgl_input = $_POST['tgl_input'];
            $nama_barang = $_POST['nama_barang'];
            $kode_barang = $_POST['kode_barang'];
            $merk = $_POST['merk'];
            $harga_beli = $_POST['harga_beli'];
            $harga_jual = $_POST['harga_jual'];
            $stok = $_POST['stok'];
            $expiry_date = $_POST['expired_date'];
            $kategori = $_POST['t-kategori'];
            $supplier = $_POST['t-supplier'];


            $total_pembayaran = $stok * $harga_beli;
            
            $result = mysqli_query($koneksi, "SELECT MAX(id_pembelian) as max_id FROM pembelian");
            $row = mysqli_fetch_assoc($result);
            $max_id = $row['max_id'];
            $pembelian_id = ($max_id !== null) ? $max_id + 1 : 1;

            $result_produk = mysqli_query($koneksi, "SELECT MAX(id_produk) as max_produk_id FROM produk");
            $row_detail = mysqli_fetch_assoc($result_produk);
            $max_detail_id = $row_detail['max_produk_id'];
            $produk_id = ($max_detail_id !== null) ? $max_detail_id + 1 : 1;

            

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $conn = new mysqli($server, $username, $password, $db);
            
                // Query SQL untuk memasukkan data ke dalam database
                $sql1 = "INSERT INTO produk (updated_at, nama_produk, kode_produk, merk, harga_beli, harga_jual, stok, expiyed_date, id_kategori, id_supplier, id_user)
                            VALUES ('$tgl_input', '$nama_barang', '$kode_barang', '$merk', '$harga_beli', '$harga_jual', '$stok', '$expiry_date', '$kategori', '$supplier', '$sesID')";
                
                
                if (mysqli_query($koneksi, $sql1)) {
                    // SQL 2 executed successfully
                    echo "<script>
                            alert('Menu berhasil ditambahkan');
                        </script>";
                } else {
                    echo "<script>
                            alert('Error: " . $sql1 . "\\n" . mysqli_error($koneksi) . "');
                        </script>";
                }
            // Execute SQL 2
            $total_pembayaran = $stok * $harga_beli;

             $sql2 = "INSERT INTO pembelian (tanggal_pembelian, total_pembayaran, id_user)
             VALUES ('$tgl_input', '$total_pembayaran', '$sesID')";

             if (mysqli_query($koneksi, $sql2)) {
                // SQL 2 executed successfully
                echo "<script>
                        alert('Menu berhasil ditambahkan');
                    </script>";
            } else {
                echo "<script>
                        alert('Error: " . $sql2 . "\\n" . mysqli_error($koneksi) . "');
                    </script>";
            }

            $sql3 = "INSERT INTO detail_pembelian(id_pembelian, id_produk, jumlah, subTotal)
            VALUES ($pembelian_id, '$produk_id', $stok, $total_pembayaran)";
            if (mysqli_query($koneksi, $sql3)) {
                // SQL 3 executed successfully
                echo "<script>
                        alert('Menu berhasil ditambahkan');
                    </script>";
            } else {
                echo "<script>
                        alert('Error: " . $sql3 . "\\n" . mysqli_error($koneksi) . "');
                    </script>";
            }
        }
    }
        ?>
        
        <!-- DataTales Semua Produk -->
        <div class="px-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Semua Produk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Merk</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Expiyed</th>
                                    <th>Tanggal Update</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>

                        <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, 'SELECT * FROM produk ORDER BY expiyed_date DESC');
                            while ($data = mysqli_fetch_array($tampil)):
                        ?>
                            <tr>
                                <td><?= $no++?></td>
                                <td><?= $data['nama_produk'] ?></td>
                                <td><?= $data['merk'] ?></td>
                                <td><?= $data['harga_beli'] ?></td>
                                <td><?= $data['harga_jual'] ?></td>
                                <td><?= date('d-m-Y', strtotime($data['expiyed_date'])) ?></td>
                                <td><?= date('d-m-Y', strtotime($data['updated_at'])) ?></td>
                                <td><?= $data['stok'] ?></td>
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
                                    <button class="btn-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="aksi_crud.php">
                                        <input type="hidden" name= "id_produk" value= "<?= $data['id_produk'] ?>">
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
                                        <label class="form-label">Total Stok :</label>
                                        <input type="text" class="form-control" name="tstok" value="<?= $data['stok'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tambah Stok :</label>
                                        <input type="text" class="form-control" name="tambahstok" value="0">
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
    <!-- DataTables script -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables initialization script -->
<script src="js/demo/datatables-simple-demo.js"></script>


</body>
</html>