<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "proyek";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
     die("tidak dapat terkoneksi");
}
$id = "";
$psw = "";
$nama = "";
$alamat = "";
$error = "";
$sukses = "";

if (isset($_GET['op'])) {
     $op = $_GET['op'];
} else {
     $op = "";
}
if ($op == 'delete') {
     $id = $_GET['id'];
     $sql5 = "DELETE FROM `pengguna` WHERE id_user = '$id'";
     $q5   = mysqli_query($koneksi, $sql5);
     if ($q5) {
          $sukses = "berhasil dihapus";
     } else {
          $error = "tidak berhasil dihapus";
     }
}

if ($op == 'edit') {
     $id = $_GET['id'];
     $sql3 = "SELECT * FROM pengguna WHERE id_user = '$id'";
     $q1 = mysqli_query($koneksi, $sql3);
     $r1 = mysqli_fetch_array($q1);
     $id = $r1["id_user"];
     $nama = $r1["nama"];
     $psw = $r1["password"];
     $alamat = $r1["Alamat"];

     if ($id == '') {
          $error = "data tidak ketemu";
     }
}
if (isset($_POST["simpan"])) {
     $id = $_POST["id"];
     $nama = $_POST["nama"];
     $psw = $_POST["Pass"];
     $alamat = $_POST["alamat"];


     if ($id && $psw && $nama && $alamat) {
          if ($op == 'edit') {
               $sql4 = "UPDATE `pengguna` SET `id_user`='$id',`nama`='$nama',`password`='$psw',`Alamat`='$alamat' WHERE id_user='$id'";
               $q4 = mysqli_query($koneksi, $sql4);
               if ($q4) {
                    $sukses = "data berhasil";
               } else {
                    $error = "data tidak berhasil";
               }
          } else {
               $sqli = "INSERT INTO pengguna(id_user, nama, password, Alamat) VALUES ('$id', '$nama','$psw', '$alamat')";
               $sq1 = mysqli_query($koneksi, $sqli);
               if ($sq1) {
                    $sukses = "berhasil";
               } else {
                    $error = "tidak";
               }
          }
     } else {
          $error = "masukkan data";
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>data user</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
     <style>
          .mx-auto {
               width: 800px;
          }

          .card {
               margin-top: 10px;
          }
     </style>
</head>

<body>
     <div class="mx-auto">
          <div class="card">
               <div class="card-header">
                    Cretae / Edit Data
               </div>
               <div class="card-body">
                    <?php
                    if ($error) {
                    ?>
                         <div class="alert alert-danger" role="alert">
                              <?php echo $error ?>
                         </div>
                    <?php
                         header("refresh:5;url=user.php");
                    }
                    ?>

                    <?php
                    if ($sukses) {
                    ?>
                         <div class="alert alert-success" role="alert">
                              <?php echo $sukses ?>
                         </div>
                    <?php
                         header("refresh:5;url=user.php");
                    }
                    ?>
                    <form action="" method="POST">
                         <div class="mb-3 row">
                              <label for="ID" class="col-sm-2 col-form-label">Id User</label>
                              <div class="col-sm-10">
                                   <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ?>">
                              </div>
                         </div>
                         <div class="mb-3 row">
                              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                              <div class="col-sm-10">
                                   <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                              </div>
                         </div>
                         <div class="mb-3 row">
                              <label for="Pass" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                   <input type="text" class="form-control" id="Pass" name="Pass" value="<?php echo $psw ?>">
                              </div>
                         </div>
                         <div class="mb-3 row">
                              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                              <div class="col-sm-10">
                                   <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                              </div>
                         </div>
                         <div class="col-12">
                              <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                         </div>
                    </form>
               </div>
          </div>
          <div class="card">
               <div class="card-header text-white bg-secondary">
                    Data mahasiswa
               </div>
               <div class="card-body">
                    <table class="table">
                         <thead>
                              <tr>
                                   <th scope="col">#</th>
                                   <th scope="col"> ID </th>
                                   <th scope="col">Nama</th>
                                   <th scope="col">Password</th>
                                   <th scope="col">Alamat</th>
                                   <th scope="col">aksi</th>
                              </tr>
                         <tbody>
                              <?php
                              $sql2 = "SELECT * FROM pengguna ORDER BY id_user DESC";
                              $sq2 = mysqli_query($koneksi, $sql2);
                              $urut = 1;
                              while ($r2 = mysqli_fetch_array($sq2)) {
                                   $id       = $r2['id_user'];
                                   $nama     = $r2['nama'];
                                   $psw      = $r2["password"];
                                   $alamat   = $r2["Alamat"];
                              ?>
                                   <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $id ?></td>
                                        <td scope="row"><?php echo $nama ?></td>
                                        <td scope="row"><?php echo $psw ?></td>
                                        <td scope="row"><?php echo $alamat ?></td>
                                        <td scope="row">
                                             <a href="user.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-danger">edit</button></a>
                                             <a href="user.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau hapus data?')"><button type="button" class="btn btn-warning">delete</button></a>

                                        </td>
                                   </tr>
                              <?php
                              }
                              ?>
                         </tbody>
                         </thead>
                    </table>
               </div>
          </div>
     </div>
</body>

</html>