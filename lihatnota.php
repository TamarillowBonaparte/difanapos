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

$PilihID = isset($_GET['id']) ? $_GET['id'] : null;

$tanggal = mysqli_query($koneksi, "SELECT date_format(tgl_penjualan, '%d %M %Y') as formatted_date FROM penjualan where id_penjualan = $PilihID");
$ambil_tgl = $tanggal->fetch_assoc();

// Menampilkan kasir yang bertugas pada transaksi
$kasir = mysqli_query($koneksi, "SELECT penjualan.id_user, user.username FROM penjualan JOIN user ON penjualan.id_user = user.id_user WHERE id_penjualan = '$PilihID'");
$ambilKasir = $kasir->fetch_assoc();
$namaKasir = $ambilKasir['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>print</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style>
        @media print {
            body {
                width: 80mm;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
            }

            table {
                width: 100%;
            }

            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            th, td {
                padding: 5px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .pull-right {
                text-align: right;
                margin-top: 10px;
            }

            p.dashed-line {
                border-bottom: 1px dashed #000;
                padding-bottom: 2px;
                margin-bottom: 2px;
            }

            .col-print {
                display: none; /* Hide the columns in print mode */
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
                    <p><?php echo  $ambil_tgl['formatted_date']; ?></p>
                    <p>Kasir : <?php echo htmlentities($namaKasir); ?></p>
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
                    
                    if ($koneksi->connect_error) {
                        die("Koneksi ke database gagal: " . $koneksi->connect_error);
                    }

                    // Query untuk mendapatkan data penjualan
                    $query = "SELECT dp.id_detailPenjualan, p.nama_produk, p.harga_jual, dp.jumlah, dp.subTotal
                                FROM detail_penjualan dp
                                JOIN produk p ON dp.id_produk = p.id_produk
                                WHERE id_penjualan = '$PilihID'";

                    $result = $koneksi->query($query);


                    if ($result === false) {
                        // Query execution failed
                        die("Error executing query: " . $koneksi->error);
                    }

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_produk'] . "</td>";
                            echo "<td>" . $row['harga_jual'] . "</td>";
                            echo "<td>" . $row['jumlah'] . "</td>";
                            echo "<td>" . $row['subTotal'] . "</td>"; // Corrected case here
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
                $query_pembayaran = "SELECT total, pembayaran, kembalian FROM penjualan WHERE id_penjualan = '$PilihID'";
                $result_pembayaran = $koneksi->query($query_pembayaran);

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