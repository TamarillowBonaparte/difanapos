<?php
require("koneksi.php");
session_start();
if(!isset($_SESSION['id_user'])){
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesID = $_SESSION ['id_user'];
$sesName = $_SESSION ['username'];
$sesLvl = $_SESSION [ 'level'];

$ambilIDPenjualanTerakhir = mysqli_query($koneksi, "SELECT MAX(ID_Penjualan) as max_id FROM penjualan;");
$maxID = mysqli_fetch_assoc($ambilIDPenjualanTerakhir);

$IDterakhir = $maxID['max_id'];

?>
<html>
<head>
    <title>print</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style>
        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                font-size: 12pt;
            }

            table {
                font-size: 10pt;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <center>
                    <p><?php echo "SIDINAF" ?></p>
                    <p><?php echo "Jl.BersamaTidakBersatu" ?></p>
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <?php echo "<p>" . date("j F Y, G:i") . "</p>"; ?>
                    <p>Kasir : <?php echo htmlentities($sesName); ?></p>
                </center>
                <table class="table table-bordered" style="width:100%;">
                    <tr>
                        <td>No.</td>
                        <td>Nama Produk</td>
                        <td>Harga</td>
                        <td>Jumlah</td>
                        <td>SubTotal</td>
                    </tr>
                    <?php
                    // Koneksi ke database (gantilah dengan koneksi sesuai dengan database Anda)
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "aplikasidijee";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Koneksi ke database gagal: " . $conn->connect_error);
                    }

                    // Query untuk mendapatkan data penjualan
                    $query = "SELECT dp.id_detailPenjualan,pb.nama_produk, p.harga_jual, dp.jumlah, dp.subTotal
                                FROM detailpenjualan dp
                                JOIN barang b ON dp.id_produk = p.id_produk
                                WHERE ID_Penjualan = '$IDterakhir'";
                    $result = $koneksi->query($query);

                    if ($result === false) {
                        // Query execution failed
                        die("Error executing query: " . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        $no = 1;

                        // Tampilkan data penjualan dalam bentuk tabel
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_barang'] . "</td>";
                            echo "<td>" . $row['harga_jual'] . "</td>";
                            echo "<td>" . $row['jumlah'] . "</td>";
                            echo "<td>" . $row['subtotal'] . "</td>";
                            echo "</tr>";

                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data penjualan</td></tr>";
                    }

                    ?>
                </table>
                <?php
                // Query untuk mendapatkan data pembayaran dan kembalian
                $query_pembayaran = "SELECT total, pembayaran, kembalian FROM penjualan WHERE id_penjualan = '$IDterakhir'";
                $result_pembayaran = $conn->query($query_pembayaran);

                if ($result_pembayaran === false) {
                    // Query execution failed
                    die("Error executing query: " . $conn->error);
                }

                if ($result_pembayaran->num_rows > 0) {
                    $row_pembayaran = $result_pembayaran->fetch_assoc();
                    $total = $row_pembayaran['total'];
                    $pembayaran = $row_pembayaran['pembayaran'];
                    $kembalian = $row_pembayaran['kembalian'];

                    echo '<div class="pull-right">';
                    echo 'Total : Rp.' . number_format($total) . ',<br />';
                    echo 'Bayar : Rp.' . number_format($pembayaran) . ',<br />';
                    echo 'Kembali : Rp.' . number_format($kembalian) . ',';
                    echo '</div>';
                }
                ?>
                <div class="clearfix"></div>
                <center>
                    <p>Terima Kasih Telah berbelanja di toko kami !</p>
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>