<?php
require '../koneksi.php';

if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if (empty($username and $password) || empty($username) || empty($password)) {
        $_SESSION['alertLogin'] = 'Data tidak boleh kosong';
    } else {
        $user = query("SELECT * FROM users WHERE username = '$username'")[0];
        if ($user) {
            if ($user['role'] === 'admin') {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['admin'] = $user;
                    header("Location: ../admin/dashboard.php");
                } else {
                    $_SESSION['alertLogin'] = 'Password salah';
                }
            }
            if ($user['role'] === 'user') {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user'] = $user;
                    header("Location: ../user/index.php");
                } else {
                    $_SESSION['alertLogin'] = 'Password salah';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Uprak PHP - Login</title>

    <!-- Custom fonts for this template-->
    <link href="./asset/pakage/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(to right, #232526, #414345);
        }

        button:first-of-type {
            background-image: linear-gradient(to right, #232526, #414345);
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php if (isset($_SESSION['alertLogin'])) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $_SESSION['alertLogin'] ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?php unset($_SESSION['alertLogin']) ?>
                                        </div>
                                    <?php } ?>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="username" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" name="remember" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="sbt btn btn-user btn-block">
                                            Login
                                        </button>
                                        <a href="../index.php" class="btn btn-success btn-user btn-block">back</a>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../asset/pakage/jquery/jquery.min.js"></script>
    <script src="../asset/pakage/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../asset/pakage/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../asset/js/sb-admin-2.min.js"></script>

</body>

</html>