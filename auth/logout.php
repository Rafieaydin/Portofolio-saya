<?php 
session_start();
if ($_SESSION['user']) {
    session_unset('user');
} else if ($_SESSION['admin']) {
    session_unset('admin');
}
header("Location: ../index.php");
