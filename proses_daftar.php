<?php
include "koneksi.php";

//INISIASI NILAI METHOD POST
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$alamat = $_POST['alamat'];

//MEMERIKSA UNIQUE VALUE
$query_unique = mysqli_query($conn, "select * from user where email_user = '$email'");
$data_unique = mysqli_fetch_array($query_unique);
if (!empty($data_unique['email_user'])) {
    echo "<script>alert('Email already in used');location.href='signup.html';</script>";
} else {
    //
    if (empty($nama) || empty($jenis_kelamin) || empty($email) || empty($password) || empty($alamat)) {
        echo "<script>alert('Data tidak boleh kosong');location.href='signup.html';</script>";
    } else {
        if (!empty($_FILES["foto"])) {
            if ($_FILES["foto"]["size"] <= (5 * 1024 * 1024)) {
                $dir = "components/profile/";
                $targetFile = $dir . basename("foto $email");
                move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
                $foto = mysqli_real_escape_string($conn, file_get_contents($targetFile));
                $daftar = mysqli_query($conn, "insert into user (nama_user,jenis_kelamin,email_user,password_user,alamat_user,foto_user) value ('$nama','$jenis_kelamin','$email','$password','$alamat','$foto')");
                if ($daftar) {
                    echo "<script>alert('Daftar berhasil');location.href='login.html';</script>";
                } else {
                    echo "<script>alert('Daftar gagal');location.href='signup.html';</script>";
                }
            } else {
                echo "<script>alert('File is too large ( 5 Mb max )');location.href='signup.html';</script>";
            }
        } else {
            $daftar = mysqli_query($conn, "insert into user (nama_user,jenis_kelamin,email_user,password_user,alamat_user) value ('$nama','$jenis_kelamin','$email','$password','$alamat')");
            if ($daftar) {
                echo "<script>alert('Daftar berhasil');location.href='login.html';</script>";
            } else {
                echo "<script>alert('Daftar gagal');location.href='signup.html';</script>";
            }
        }
    }
}
?>