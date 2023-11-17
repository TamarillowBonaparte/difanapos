<?php
session_start();

$index = $_POST['index'];

// Hapus item dari session keranjang
unset($_SESSION['keranjang'][$index - 1]);
?>
