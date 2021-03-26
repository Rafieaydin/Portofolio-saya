<?php
$server = "localhost";
$user = "root";
$password = "";
$database  = "portofolio_gue";
$conn = mysqli_connect($server, $user, $password, $database);

// untuk show
function query($query)
{

    global $conn;
    $result = mysqli_query($conn, $query);

    $box = [];
    if (empty($result)) {
        $box[] = '';
        return $box;
    }

    while ($isi = mysqli_fetch_assoc($result)) {
        $box[] = $isi;
    }
    return $box;
}

function tambahContact($post){
    global $conn;
    $email = htmlspecialchars($post['email']);
    $judul = htmlspecialchars($post['judul']);
    $deskripsi = htmlspecialchars($post['deskripsi']);

    if (empty($email or $judul or $deskripsi)) {
        return 0;
    }

    $query = "INSERT INTO contact VALUES('','$email','$judul','$deskripsi')";

    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}