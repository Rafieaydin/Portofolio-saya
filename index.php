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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="asset/js/js.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark shadow ">
        <div class="container">
            <a class="navbar-brand fw-bold ms-5  text-white " href="#">AYN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ms-3 ">
                        <a class="nav-link active text-white " aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item ms-3 ">
                        <a class="nav-link text-white" href="#skils">Skills</a>
                    </li>
                    <li class="nav-item ms-3   ">
                        <a class="nav-link text-white " href="#projects">Project</a>
                    </li>
                    <li class="nav-item ms-3 me-5">
                        <a class="nav-link text-white" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home">
        <div class="row ms-3 justify-content-center">
            <div class="col-md-6 mt-5 pt-5 mb-5">
                <div class="title mt-5 fw-bold fs-1">
                    Hello , Im Aydin
                </div>
                <div class="description">
                    I'm from Indonesia, I have been working as freelance front-end developer. If you want to hire me or doing some open souce project please don't hestitate to contact me.
                </div>
                <div class="social-media mt-3">
                    <a href="" class="badge text-white">
                        <i class="fab fa-instagram fa-3x"></i>
                    </a>
                    <a href="" class="badge text-white">
                        <i class="fab fa-facebook fa-3x"></i>
                    </a>
                    <a href="" class="badge text-white">
                        <i class="fab fa-github fa-3x"></i>
                    </a>
                    <a href="" class="badge text-white">
                        <i class="fab fa-linkedin fa-3x"></i>
                    </a>
                </div>

            </div>
            <div class="col-md-4">
                <div class="image  mt-5 text-center">
                    <img src="asset/image/image.jpeg" class=" w-75 ms-5 me-5  rounded-pill shadow " alt="">
                </div>
            </div>
        </div>

    </section>

    <section id="skils">
        <div class="container text-center  pb-5">
            <h1 class="text-center pt-5">MY SKILS</h1>
            <div class="row justify-content-center ">
                <div class="col-md-4">
                    <img src="asset/image/Programming-pana.svg" alt="">
                    <h4>Fullstack Developer</h4>
                    <p class="fw-light font14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis
                        repellat, aliquid itaque nam velit quam dolorem laborum temporibus animi recusandae.</p>
                </div>
                <div class="col-md-4">
                    <img src="asset/image/ui.svg" alt="">
                    <h4>UI / UX Desainer</h4>
                    <p class="fw-light font14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis
                        repellat,
                        aliquid itaque nam
                        velit quam dolorem laborum temporibus animi recusandae.</p>
                </div>
                <div class="col-md-4">
                    <img src="asset/image/Programming-pana.svg" alt="">
                    <h4>Game Developer</h4>
                    <p class="fw-light font14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis
                        repellat,
                        aliquid itaque nam
                        velit quam dolorem laborum temporibus animi recusandae.</p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section id="projects">
        <h1 class="text-center pt-5 mb-3">MY PROJECT</h1>
        <div class="container project-container  pb-5">
            <div class="row justify-content-center mt-3 ">
                <?php foreach ($projek as $pro) { ?>
                    <div class="col-md-3 mt-3">
                        <a href="<?= $pro['link'] ?>" target="_blank" class="card-link">
                            <div class="card">
                                <img src="data:image/png;base64,<?= base64_encode($pro['image']) ?>" class="card-img-top" alt="...">
                                <p class="text-center fw-bold text-dark mt-2"><?= $pro['judul'] ?></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container  pt-5">
            <h1 class=" pt-5 mb-3 contact ">CONTACT</h1>
            <div class="row pb-3">
                <div class="col-md-6">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address :</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="Name" class="form-label">Judul : </label>
                            <input type="judul" class="form-control" id="Name" name="judul" placeholder="Masukan Judul anda">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi :</label>
                            <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">submit</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <section id="footer" class="pt-5">
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
                    location.href='unset.php';
                } 
            })
        }
    </script>


</body>

</html>