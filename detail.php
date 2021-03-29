<?php
require 'koneksi.php';
session_start();
if (isset($_POST['submit'])) {
    if (tambahContact($_POST) > 0) {
        $_SESSION['sukses'] = 'Pesan anda sudah tersampaikan';
        header('Location: index.php');
    } else {
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $projek = query("SELECT * FROM projek WHERE skill_id = $id");
    $skill = query("SELECT * FROM skill WHERE id = $id")[0];
} else {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Portofolio</title>
    <link rel="stylesheet" href="asset/node_modules/bootstrap/dist/css/bootstrap.min.css">
    </link>
    <script src="asset/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link href="asset/pakage/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="asset/css/detail.css">
    </link>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="asset/js/js.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light  ">
        <div class="container">
            <a class="navbar-brand fw-bold ms-5  text-white " href="#">AYN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ms-3 ">
                        <a class="nav-link  text-white" href="index.php#home">Home</a>
                    </li>
                    <li class="nav-item ms-3 ">
                        <a class="nav-link text-white" href="index.php#skils">Skills</a>
                    </li>
                    <li class="nav-item ms-3   ">
                        <a class="nav-link text-white active " href="#">Project</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link text-white" href="index.php#contact">Contact</a>
                    </li>
                    <li class="nav-item ms-3 me-5">
                        <a class="nav-link text-white" href="auth/login.php"><i class="fas fa-user"></i> &ensp; Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="projects">
        <h1 class="text-center  mt-3 pt-5 text-white" style="font-size: 50px;" data-aos="fade-up">Project <?= $skill['nama'] ?></h1>
        <a href="index.php" class="text-center  kembali" style="font-size: 25px;" data-aos="fade-up"><i class="fa fa-arrow-left"></i> kembali ke Home</h3>
            <div class="container  pt-5 pb-5">
                <div class="row justify-content-center mb-5 pb-5 " data-aos="fade-up">
                    <?php foreach ($projek as $pro) { ?>
                        <div class="col-md-4 mb-3">
                            <a href="<?= $pro['link'] ?>" target="" class="card-link">
                                <div class="card">
                                    <img src="data:image/png;base64,<?= base64_encode($pro['image']) ?>" class="card-img-top" alt="...">
                                    <p class="text-center fw-bold text-white mt-2"><?= $pro['judul'] ?></p>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
    </section>


    <?php if (isset($_SESSION['sukses'])) { ?>
        <div id="alert"><?= $_SESSION['sukses'] ?></div>
    <?php } ?>
    <?php

    ?>
    <script>
        $(document).ready(function name(params) {
            $('#alert').hide();
            var alert = $('#alert').text();
            if (alert) {
                Swal.fire(
                    'Berhasil !',
                    $('#alert').val(),
                    'success'
                ).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        location.href = 'unset.php';
                    }
                })
            }
            $("nav li a").on('click', function(e) {
                $('nav li a').removeClass('active');
                $(this).addClass('active');
                $(this).filter(function() {
                    return this.href === location.href;
                }).addClass('active');
            });
            $("li a").filter(function() {
                return this.href === location.href;
            }).addClass('active');

            AOS.init();
        })
    </script>


</body>

</html>