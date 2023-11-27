<?php
require('koneksi.php');
session_start();
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login #2</title>




</head>


<body>

    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url(img/jajan.jpg);"></div>

        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <!-- Nested Row within Card Body -->
                    <div class="col-md-7">
                        <h3>Login to <strong>SIDINAF</strong></h3>
                        <p class="mb-4">Welcome back! Please enter your login information.</p>
                        <form action="index.php" method="post">
                            <div class="form-group first">
                                <label for="inputEmail">Username</label>
                                <input class="form-control" type="text" placeholder="username" name="txt_username" />
                                <!-- <label for="inputEmail">Username</label> -->
                                <div class="">
                                    <?php global $error;
                                    echo $error ?>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="inputPassword">Password</label>
                                <input class="form-control" type="password" placeholder="password" name="txt_pass" />
                                <!-- <label for="inputPassword">Password</label> -->
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="password.html">Lupa Password?</a>
                                <button class="btn btn-block btn-primary" type="submit" name="submit">Login</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="register.html">Create an Account!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    </div>

    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>


</body>

</html>