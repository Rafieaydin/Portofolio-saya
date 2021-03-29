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
$projek = query("SELECT * FROM projek");

$skill = query("SELECT skill.id AS id, skill.nama,skill.deskripsi, skill.gambar, GROUP_CONCAT(tag.nama)  AS nama_tag  FROM tag_skill 
LEFT JOIN  skill ON tag_skill.id_skill = skill.id
LEFT JOIN  tag ON tag_skill.id_tag = tag.id
GROUP BY skill.id");

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
    <link rel="stylesheet" href="asset/css/css.css">
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
                        <a class="nav-link  text-white active" href="#home">Home</a>
                    </li>
                    <li class="nav-item ms-3 ">
                        <a class="nav-link text-white" href="#skils">Skills</a>
                    </li>
                    <li class="nav-item ms-3   ">
                        <a class="nav-link text-white " href="#projects">Project</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link text-white" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item ms-3 me-5">
                        <a class="nav-link text-white" href="auth/login.php"><i class="fas fa-user"></i> &ensp; Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home">
        <div class="container pt-5">
            <div class="row ms-3 justify-content-center">
                <div class="col-md-6 mt-5 pt-5 mb-5">
                    <div class="title mt-5 fw-bold fs-1" data-aos="fade-up">
                        Hello , Im Aydin
                    </div>
                    <div class="description" data-aos="fade-up">
                        I'm from Indonesia, I have been working as freelance front-end developer. If you want to hire me or doing some open souce project please don't hestitate to contact me.
                    </div>
                    <div class="social-media mt-3">
                        <a href="" class="badge text-white" data-aos="fade-up">
                            <i class="fab fa-instagram fa-3x"></i>
                        </a>
                        <a href="" class="badge text-white" data-aos="fade-up">
                            <i class="fab fa-facebook fa-3x"></i>
                        </a>
                        <a href="" class="badge text-white" data-aos="fade-up">
                            <i class="fab fa-github fa-3x"></i>
                        </a>
                        <a href="" class="badge text-white" data-aos="fade-up">
                            <i class="fab fa-linkedin fa-3x"></i>
                        </a>
                    </div>

                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="image  mt-5 text-center">
                        <img src="asset/image/image2.jpeg" class=" w-75 ms-5 me-5 rounded-pill shadow " alt="">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="skils" class="pb-5">
        <div class="container pt-5 pb-5">
            <h1 class="text-center  mt-3 pt-5 pb-4  " style="font-size: 50px;" data-aos="fade-up">Skills</h1>
            <div class=" row justify-content-center text-center mt-5 " data-aos="fade-up">
                <?php foreach ($skill as $skills) { ?>
                    <div class="col-md-4 mb-5">
                        <a href="detail.php?id=<?= $skills['id'] ?>" class="text-decoration-none text-white">
                            <img src="data:image/jpeg;base64,<?= base64_encode($skills['gambar']) ?>" alt="" style="width: 260px; height:260px; object-fit:cover">
                            <h3 class="mt-2"><?= $skills['nama'] ?></h3>

                            <div class="badge-tag mb-3">
                                <?php $ex = explode(',', $skills['nama_tag']);
                                foreach ($ex as $key => $value) { ?>
                                    <span class="badge bg-secondary"><?= $value ?></span>
                                <?php } ?>
                            </div>
                            <p class="font-weight-light"><?= $skills['deskripsi'] ?></p>
                        </a>
                    </div>
                <?php } ?>
                <!-- <div class="col-md-4 ">
                    <img src="asset/image/Font-amico.svg" class="w-75 " alt="">
                    <h3 class="mt-2">UI / UX Desainer</h3>
                    <div class="badge-tag mb-3">
                        <span class="badge bg-secondary">Figma</span>
                        <span class="badge bg-secondary">Adobe XD</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="asset/image/Online_games_addiction-amico.svg" class="w-75" alt="">
                    <h3 class="mt-2">Game Developer</h3>
                    <div class="badge-tag mb-3">
                        <span class="badge bg-secondary">C+</span>
                    </div>
                </div> -->

            </div>
        </div>
        </div>
    </section>

    <section id="projects" class="pb-5 pt-5 ">
        <h1 class="text-center mt-3 pt-5 pb-5" style="font-size: 50px;" data-aos="fade-up">Project</h1>
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

    <section id="contact">
        <div class="container ">
            <div class="row ">
                <h1 class="mt-3 pt-5" style="font-size: 50px;" data-aos="fade-up">contact us</h1>
                <h4 style="text-align:center" data-aos="fade-up">We'd love to hear from you!</h4>
            </div>
            <form action="" method="POST">
                <div class="row input-container">

                    <div class="col-xs-12" data-aos="fade-up">
                        <div class="styled-input wide">
                            <input type="text" name="nama" required />
                            <label>Name</label>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up">
                        <div class="styled-input" style="width: 100%">
                            <input type="email" name="email" required />
                            <label>Email</label>
                        </div>
                    </div>
                    <div class="col-md-6 " data-aos="fade-up">
                        <div class="styled-input" style="float:right;width:100%;">
                            <input type="text" name="no_telp" required />
                            <label>Phone Number</label>
                        </div>
                    </div>
                    <div class="col-xs-12" data-aos="fade-up">
                        <div class="styled-input wide">
                            <textarea required name="pesan"></textarea>
                            <label>Message</label>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" name="submit" class="btn-lrg submit-btn">Kirim Pesan</button>
                    </div>
            </form>
        </div>
        </div>


        <footer class="text-center text-white">
            <!-- Copyright -->
            <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2021 Copyright:
                <a class="text-white" href="">Rafieaydin</a>
            </div>
            <!-- Copyright -->
        </footer>
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