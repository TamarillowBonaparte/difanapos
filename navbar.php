<?php

require ("koneksi.php");
// Koneksi ke database (gantilah dengan koneksi sesuai kebutuhan)
$koneksi = mysqli_connect($server, $username, $password, $db);

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$tanggalSekarang = date("Y-m-d");
$tanggalTigaBulan = date("Y-m-d", strtotime("+1 months"));

// Query untuk mendapatkan data produk dengan tanggal kedaluwarsa kurang dari 3 bulan dari hari ini
$sql = "SELECT * FROM produk WHERE expiyed_date BETWEEN '$tanggalSekarang' AND '$tanggalTigaBulan'";

// Eksekusi query
$result = mysqli_query($koneksi, $sql);

// Hitung jumlah produk yang tanggal kedaluwarsa kurang dari 3 bulan dari hari ini
$count = mysqli_num_rows($result);

// $lowStockQuery = "SELECT * FROM produk WHERE stock < 5";
// $lowStockResult = mysqli_query($connection, $lowStockQuery);
// $lowStockCount = mysqli_num_rows($lowStockResult);

$sql2 = "SELECT * FROM produk WHERE stok < 5";
$lowStockResult = mysqli_query($koneksi, $sql2);
$count2 = mysqli_num_rows($lowStockResult);


$akses = ($sesLvl == 1) ? 'style=""' : 'style="display: none;"';
$akses2 = ($sesLvl == 2) ? 'style=""' : 'style="display:none;"';

?>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon ">
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
                        <span>Dashboard</span>
                    </a>
                </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Fitur Aplikasi
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
                        <a class="collapse-item" href="kategori.php">Supplier & Kategori</a>
                        <!-- <a class="collapse-item" href="cards.html">Data Produk Return</a> -->
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="kasir.php">
                <i class="fa-solid fa-cash-register"></i>
                    <span>Kasir</span>
                </a>
            </li>
            
            <li class="nav-item" <?php echo $akses ?>>
                <a class="nav-link" href="laporan.php">
                <i class="fa-solid fa-money-bill-transfer"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li class="nav-item" <?php echo $akses ?>>
                <a class="nav-link" href="tables.php">
                <i class="fa-solid fa-person-chalkboard"></i>
                    <span>Manajemen Karyawan</span>
                </a>
            </li>

            <li class="nav-item" <?php echo $akses ?>>
                <a class="nav-link" href="dataprodukkeluar.php">
                <i class="fa-solid fa-boxes-packing"></i>
                    <span>Produk Return</span>
                </a>
            </li>

            <li class="nav-item" <?php echo $akses ?>>
                <a class="nav-link" href="riwayatlogin.php">
                <i class="fa-solid fa-list"></i>
                    <span>Riwayat Login</span>
                </a>
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
                                    <span class="badge badge-danger badge-counter"><?php echo $count; ?></span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Notifikasi Produk Expiyed
                                    </h6>
                                    <?php
                                    // Loop untuk menampilkan data produk yang tanggal kedaluwarsa kurang dari 3 bulan dari hari ini
                                    $displayedProducts = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($displayedProducts >= 4) {
                                            break; // Keluar dari loop jika sudah menampilkan 4 produk
                                        }
                                        ?>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                            <div class="small text-danger">Tgl Expiyed: <?php echo date('d-m-Y', strtotime($row['expiyed_date'])); ?></div>
                                                <?php echo $row['nama_produk']; ?>
                                            </div>
                                        </a>
                                        <?php
                                        $displayedProducts++;
                                    }

                                    // Jika tidak ada produk yang kedaluwarsa
                                    if ($count == 0) {
                                        ?>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Tidak Ada Produk Expiyed</a>
                                        <?php
                                    }
                                    ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="produk.php">Cek Produk Lebih Lanjut</a>
                                </div>
                            </li>


                       <!-- Nav Item - Low Stock Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="lowStockAlertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                    <!-- Counter - Low Stock Alerts -->
                                    <span class="badge badge-danger badge-counter"><?php echo $count2; ?></span>
                                </a>
                                <!-- Dropdown - Low Stock Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="lowStockAlertsDropdown">
                                    <h6 class="dropdown-header">
                                        Notifikasi Stok Produk
                                    </h6>
                                    <?php
                                    // Loop to display products with low stock
                                    $displayedLowStockProducts = 0;
                                    while ($row = mysqli_fetch_assoc($lowStockResult)) {
                                        if ($displayedLowStockProducts >= 4) {
                                            break; // Exit the loop after displaying 4 low stock products
                                        }
                                        ?>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <!-- <i class="fas fa-exclamation-triangle text-white"></i> -->
                                                    <i class="fa-solid fa-exclamation fa-lg text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-danger">Stock: <?php echo $row['stok']; ?></div>
                                                <?php echo $row['nama_produk']; ?>
                                            </div>
                                        </a>
                                        <?php
                                        $displayedLowStockProducts++;
                                    }

                                    // Display a message if no products have low stock
                                    if ($count2 == 0) {
                                        ?>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Tidak Ada Produk Yang Hampir Habis</a>
                                        <?php
                                    }
                                    ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="produk.php">Cek Produk Lebih Lanjut</a>
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
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>                    
                </nav>
<!-- End of Topbar -->