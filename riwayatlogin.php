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
                    <h1 class="h3 mb-0 text-gray-800">RIWAYAT LOGIN</h1>
                </div>
            </div>


                <!-- DataTales Semua User -->
                    <div class="px-3">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Riwayat Login</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Login</th>
                                                <th>Session</th>
                                                <th>Log Out</th>
                                                <th>Session</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $no = 1;
                                            $tampil = mysqli_query($koneksi, "SELECT user.username, riwayatlogin.tanggal AS login_date, riwayatlogout.tanggal AS logout_date FROM user 
                                                LEFT JOIN riwayatlogin ON user.id_user = riwayatlogin.id_user
                                                LEFT JOIN riwayatlogout ON user.id_user = riwayatlogout.id_user
                                                ORDER BY user.id_user ASC");

                                            while ($data = mysqli_fetch_array($tampil)) :
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data['username'] ?></td>
                                                    <td><?= $data['login_date'] ?></td>
                                                    <td><?= $data['username'] ?></td>
                                                    <td><?= $data['logout_date'] ?></td>
                                                </tr>

                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

            <!--End Dari Semua User-->



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