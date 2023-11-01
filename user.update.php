<?php
include "koneksi.php";
session_start();

$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']);

//MENGAMBIL DATA SESSION USER
$query_s_user = mysqli_query($conn, "select * from user where id_user = " . $_SESSION['id_user'] . "");
$data_s_user = mysqli_fetch_array($query_s_user);
$old_email = $data_s_user['email_user'];
$old_password = $data_s_user['password_user'];

//MEMERIKSA UNIQUE VALUE
$query_unique = mysqli_query($conn, "select * from user where email_user = '$email'");
$data_unique = mysqli_fetch_array($query_unique);
$used_email = $data_unique['email_user'];

//EKSEKUSI PROSES UPDATE
if (empty($nama) || empty($jenis_kelamin) || empty($email) || empty($alamat)) {
    echo "<script>alert('Data tidak boleh kosong');location.href='user.php';</script>";
} else {
    $update = mysqli_query($conn, "UPDATE `user` SET `nama_user`='$nama',`jenis_kelamin`='$jenis_kelamin',`alamat_user`='$alamat' WHERE id_user = " . $_SESSION['id_user'] . "");

    //EMAIL UPDATE
    if ($email != $old_email /*&& empty($used_email)*/) {
        if (empty($used_email)) {
            mysqli_query($conn, "update user set email_user = '$email' WHERE id_user = " . $_SESSION['id_user'] . "");
        } else {
            echo "<script>alert('Email tidak tersedia');location.href='user.php';</script>";
        }
    }

    //PASSWORD UPDATE
    if ($password != $old_password && $password != "d41d8cd98f00b204e9800998ecf8427e" /*&& empty($used_email)*/) {
        mysqli_query($conn, "update user set password_user = '$password' WHERE id_user = " . $_SESSION['id_user'] . "");
    }

    //FOTO UPDATE
    $dir = "components/profile/";
    if (!empty($_FILES["foto"]) && $_FILES["foto"]["size"] < (5 * 1024 * 1024)) {
        $targetFile = $dir . basename($_SESSION['id_user']);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
        $foto = mysqli_real_escape_string($conn, file_get_contents($targetFile));
        mysqli_query($conn, "update user set foto_user = '$foto' WHERE id_user = " . $_SESSION['id_user'] . "");
    } else {
        echo "<script>alert('Ukuran file terlalu besar (max 5 MB)');location.href='user.php';</script>";
    }

}
if ($update) {
    echo "<script>alert('Profil berhasil diperbarui');location.href='user.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui profil');location.href='user.php';</script>";
}


?>