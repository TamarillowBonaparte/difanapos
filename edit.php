<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a form with fields for editing, adjust the field names accordingly
    $nama_produk = $_POST['nama_produk'];
    $merk = $_POST['merk'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    // Add other fields as needed

    // Assuming you're passing the product ID through the URL
    $id_produk = $_GET['id'];

    // Update the data in the database
    $query = "UPDATE produk SET 
              nama_produk = '$nama_produk',
              merk = '$merk',
              harga_beli = '$harga_beli',
              harga_jual = '$harga_jual'
              WHERE id_produk = '$id_produk'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Successful update, redirect to the desired page
        header("Location: index.php");
        exit();
    } else {
        // Handle the error, display an error message or redirect accordingly
        echo "Error updating data: " . mysqli_error($koneksi);
    }
} else {
    // Display the form for editing
    // Assuming you have a form with method="POST" and action="edit.php?id=[your_product_id]"
    // Adjust the form fields according to your actual data structure
?>
    <!-- Your HTML form for editing goes here -->
    <form method="POST" action="edit.php?id=<?php echo $_GET['id']; ?>">
        <!-- Form fields go here -->
        <input type="text" name="nama_produk" value="<?php echo $row['nama_produk']; ?>">
        <input type="text" name="merk" value="<?php echo $row['merk']; ?>">
        <input type="text" name="harga_beli" value="<?php echo $row['harga_beli']; ?>">
        <input type="text" name="harga_jual" value="<?php echo $row['harga_jual']; ?>">
        <!-- Add other fields as needed -->

        <input type="submit" value="Save Changes">
    </form>
<?php
}
?>
