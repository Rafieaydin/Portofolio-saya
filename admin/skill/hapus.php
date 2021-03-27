<?php
require '../../koneksi.php';
var_dump($_GET['id']);
if (isset($_GET['id'])) {
    if (hapusSkils($_GET['id']) > 0) {
        header("Location: index.php");
    } else {
        header("Location: index.php?err");
    }
}
