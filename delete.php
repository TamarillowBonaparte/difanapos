<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Assuming you're passing the product ID through the URL
    $id_produk = $_GET['id'];

    // Delete the data from the database
    $query = "DELETE FROM produk WHERE id_produk = '$id_produk'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Successful deletion, redirect to the desired page
        header("Location: produk.php");
        exit();
    } else {
        // Handle the error, display an error message or redirect accordingly
        echo "Error deleting data: " . mysqli_error($koneksi);
    }
} else {
    // Handle invalid requests, redirect or display an error message
    echo "Invalid request method or missing ID parameter";
}
?>
