<?php
require('koneksi.php');
session_start();
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['submit'])) {
    $email = $_POST['txt_username'];
    $pass = $_POST['txt_pass'];
    $emailCheck = mysqli_real_escape_string($koneksi, $email);
    $passCheck = mysqli_real_escape_string($koneksi, $pass);
    
    if (!empty(trim($email)) && !empty(trim($pass))) {

        //select data berdasarkan username dari database
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {

            $id = $row['id_user'];
            $userVal = $row['email'];
            $passVal = $row['password'];
            $userName = $row['username'];
            $level = $row['level'];
        }
        if ($num != 0) {
            if ($userVal == $email && $passVal == $pass) {

                $_SESSION['id_user'] = $id;
                $_SESSION['username'] = $userName;
                $_SESSION['level'] = $level;
                $idUser = $_SESSION['id_user'];
                $tanggalRiwayat = date("Y-m-d H:i:s");
                $inputlogin = mysqli_query($koneksi, "INSERT INTO riwayatlogin VALUES ('', '$idUser', '$tanggalRiwayat')");
                header('Location: home.php');
            } else {
                $error = 'user atau pass salah!!';
                //header('Location: index.php');
            }
        } else {
            $error = 'user tidak ditemukan';
            //header('Location: index.php');
        }
    } else {
        $error = 'Data tidak boleh kosong';
       // echo $error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

      
    <link rel="stylesheet" href="style.css" />
    <title>SIDINAF</title>
    <style>
      .input-field {
        position: relative;
      }

      .eye-icon-container {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
      }

      .eye-icon-container i {
        display: block;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        <form action="#" method="post" class="sign-in-form">
            <h2 class="title">Sign In To SIDINAF</h2>
            <a>Welcome to SIDINAF, Please Sign In terlebih dahulu.</a>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input class="form-control" type="text" placeholder="Masukkan Email" name="txt_username"/>
            </div>
            <div class=""><?php if(isset($error)) echo $error; ?></div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input class="form-control" type="password" id="passwordInput" placeholder="Password" name="txt_pass"/>
              <div class="eye-icon-container" onclick="togglePasswordVisibility('passwordInput')">
                <i class="fa-solid fa-eye-slash"></i>
              </div>
            </div>
            <button class="btn btn-success fs-5" type="submit" name="submit">Login</button>
          </form>
        </div>
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
          </div>
          <img src="img/login.png" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
    <script>
      function togglePasswordVisibility(passwordInputId) {
        const passwordInput = document.getElementById(passwordInputId);
        const eyeIconContainer = passwordInput.nextElementSibling;

        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIconContainer.firstElementChild.classList.remove("fa-eye-slash");
          eyeIconContainer.firstElementChild.classList.add("fa-eye");
        } else {
          passwordInput.type = "password";
          eyeIconContainer.firstElementChild.classList.remove("fa-eye");
          eyeIconContainer.firstElementChild.classList.add("fa-eye-slash");
        }
      }
    </script>

<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
  </body>
</html>
