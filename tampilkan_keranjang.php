<?php
session_start();
?>

<table class="table table-bordered w-100" id="example1">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Barang</td>
            <td>Harga</td>
            <td style="width:10%;">Jumlah</td>
            <td style="width:20%;">SubTotal</td>
            <td>Kasir</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($_SESSION['keranjang'] as $item) {
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>{$item['nama_produk']} ({$item['merk']})</td>";
            echo "<td>{$item['harga']}</td>";
            echo "<td>{$item['jumlah']}</td>";
            echo "<td>{$item['subtotal']}</td>";
            echo "<td>{$_SESSION['username']}</td>";
            echo "<td><button onclick='hapusItem($no)'>Hapus</button></td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </tbody>
</table>
