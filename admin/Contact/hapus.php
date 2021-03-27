<?php
require '../../koneksi.php';
if (isset($_GET['id'])) {
    if (hapusContact($_GET['id']) > 0) {
        header("Location: index.php");
    } else {
        header("Location: index.php?err");
    }
}
