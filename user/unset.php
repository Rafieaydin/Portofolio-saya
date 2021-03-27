<?php
session_start(); 
unset($_SESSION['sukses']);
header('Location: index.php');
