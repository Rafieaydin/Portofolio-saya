<?php 
require '../../koneksi.php';
if (isset($_GET['id'])) {
    if (hapusPorjek($_GET['id'])> 0) {
        header("Location: index.php");
    }else {
        header("Location: index.php?err");
    }
}
?>