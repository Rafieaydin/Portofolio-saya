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
    $nama = htmlspecialchars($post['nama']);
    $pesan = htmlspecialchars($post['pesan']);
    $no_telp = htmlspecialchars($post['no_telp']);

    if (empty($email or $nama or $pesan or $no_telp)) {
        return 0;
    }

    $query = "INSERT INTO contact VALUES('','$nama','$email','$no_telp','$pesan')";

    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
// register
function register($post)
{
    global $conn;
    $username = htmlspecialchars($post['username']);
    $email = htmlspecialchars($post['email']);
    $role = 'user';
    $password = password_hash($post['password'], PASSWORD_DEFAULT);
    $tanggal = date("y/m/d H:i:s");

    if (empty($username and $email and $password) || empty($username) || empty($password) || empty($email)) {
        return $_SESSION['alertRegis'] = 'Data tidak boleh kosong';
    }
    if ($post['password'] != $post['password2']) {
        return $_SESSION['alertRegis'] = 'ulangi password anda';
    }

    $CekUser = query("SELECT * FROM users  WHERE role = 'user' and username = '$username'")[0];

    if (!empty($CekUser)) {
        return $_SESSION['alertRegis'] = 'Username sudah terdaftar';
    }

    $query = "INSERT INTO users VALUES('','$username','$email','$role','$password','$tanggal',NULL)";


    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
// fortgot password
function reset_password($post)
{
    global $conn;
    $username = htmlspecialchars($post['username']);
    $password_baru = password_hash($post['password_baru'], PASSWORD_DEFAULT);
    $password = htmlspecialchars($post['password']);
    if (empty($username  and $password and $password_baru) || empty($username) || empty($password) || empty($password_baru)) {
        return $_SESSION['alertReset'] = 'Data tidak boleh kosong';
    }
    if ($post['password_baru'] === $post['password']) {
        return $_SESSION['alertReset'] = 'Password baru anda tidak boleh sama';
    }

    $user = query("SELECT * FROM users WHERE username = '$username' WHERE role = 'user' and username = '$username'")[0];

    if (empty($user)) {
        return $_SESSION['alertReset'] = 'username tidak tersedia';
    }
    if (password_verify($password, $user['password'])) {
        $query = "UPDATE users SET password = '$password_baru' WHERE username = '$username'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } else {
        return $_SESSION['alertReset'] = 'password lama anda salah';
    }
}

// admin projek 
// create , update & delete

function tambahPorjek($post){
    global $conn;
    if (empty($post['judul']) or empty($post['link']) or empty($post['image'])) {
        return 0;
    }
    $judul =  htmlspecialchars($post['judul']);
    $link= htmlspecialchars($post['link']);
    $image = $post['image'];
    $query = "INSERT INTO projek VALUES('','$link','$judul','$image')";
    var_dump(mysqli_query($conn, $query));
    return mysqli_affected_rows($conn);
}
function editprojek($post){
    global $conn;
    if (empty($post['judul']) or empty($post['link']) or empty($post['image'])) {
        return 0;
    }
    $judul =  htmlspecialchars($post['judul']);
    $link = htmlspecialchars($post['link']);
    $image = $post['image'];
    $id = $post['id'];

    $query = "UPDATE projek SET judul = '$judul', link = '$link', image = '$image' WHERE id = $id";
    var_dump(mysqli_query($conn, $query));
    return mysqli_affected_rows($conn);
}
function hapusPorjek($id){
    global $conn;
    $query = "DELETE FROM projek WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// tag admin 
function tambahTag($post){
    global $conn;
    if (empty($post['nama_tag'])) {
        return 0;
    }
    $tag_nama = htmlspecialchars($post['nama_tag']);
    $query = "INSERT INTO tag VALUES('','$tag_nama')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function editTag($post){
    global $conn;
    if (empty($post['nama_tag'])) {
        return 0;
    }
    $tag_nama = htmlspecialchars($post['nama_tag']);
    $id = $post['id'];
    $query = "UPDATE tag SET nama = '$tag_nama' WHERE id = $id";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}
function hapusTag($id)
{
    global $conn;
    $query = "DELETE FROM tag WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// skill admin
function tambahSkills($post){
    global $conn;
    if (empty($post['judul']) or empty($post['tag']) or empty($post['image'])) {
        return 0;
    }
    $judul = htmlspecialchars($post['judul']);
    $image = $_POST['image'];
    $query = "INSERT INTO skill VALUES('','$judul','$image')";
    mysqli_query($conn,$query);
    $id = mysqli_insert_id($conn);

    foreach ($_POST['tag'] as $key => $value) {
        $query = "INSERT INTO tag_skill VALUES('', $id, $value)";
        mysqli_query($conn, $query);
    }
    
    return mysqli_affected_rows($conn);
}
function hapusSkils($id)
{
    global $conn;
    $query = "DELETE FROM skill WHERE id = $id";
    var_dump(mysqli_query($conn, $query));
    return mysqli_affected_rows($conn);
}

// skill contact
function tambahContacts($post)
{
    global $conn;
    if (empty($post['nama']) or empty($post['pesan']) or empty($post['email']) or empty($post['pesan'])) {
        return 0;
    }
    $nama = htmlspecialchars($post['nama']);
    $pesan = htmlspecialchars($post['pesan']);
    $email = htmlspecialchars($post['email']);
    $no_telp = htmlspecialchars($post['no_telp']);

    $query = "INSERT INTO contact (id,nama,pesan,email,no_telp) VALUES('','$nama','$pesan','$email','$no_telp')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function editContacts($post){
    global $conn;
    if (empty($post['nama']) or empty($post['pesan']) or empty($post['email']) or empty($post['pesan'])) {
        return 0;
    }
    $nama = htmlspecialchars($post['nama']);
    $pesan = htmlspecialchars($post['pesan']);
    $email = htmlspecialchars($post['email']);
    $no_telp = htmlspecialchars($post['no_telp']);
    $id = $post['id'];
    $query = "UPDATE contact SET nama = '$nama', pesan = '$pesan', email = '$email', no_telp = '$no_telp' WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function hapusContact($id){
    global $conn;
    $query = "DELETE FROM contact WHERE id = $id";
    var_dump(mysqli_query($conn, $query));
    return mysqli_affected_rows($conn);
}