<?php
include "koneksi.php";
session_start();

$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];

//MENGAMBIL DATA SESSION USER
$query_s_user = mysqli_query($conn, "select * from user where id_user = " . $_SESSION['id_user'] . "");
$data_s_user = mysqli_fetch_array($query_s_user);

//MEMERIKSA UNIQUE VALUE
$query_unique = mysqli_query($conn, "select * from user where email_user = '$email'");
$data_unique = mysqli_fetch_array($query_unique);

if (!empty($data_unique['email_user'])) {
    //echo "<script>alert('Email tidak tersedia');location.href='update_user.php';</script>";
} else {
    if (empty($nama) || empty($jenis_kelamin) /*|| $data_unique['email_user'] == $email */|| empty($alamat)) {
        //echo "<script>alert('Data tidak boleh kosong');location.href='update_user.php';</script>";
    } else {
        $update = mysqli_query($conn, "UPDATE `user` SET `nama_user`='$nama',`jenis_kelamin`='$jenis_kelamin',`email_user`='$email',`alamat_user`='$alamat' WHERE id_user = " . $_SESSION['id_user'] . "");
        if (!empty($_FILES["foto"])) {
            if ($_FILES["foto"]["size"] <= (5 * 1024 * 1024)) {
                $dir = "components/profile/";
                $targetFile = $dir . basename("foto $email");
                move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
                $foto = mysqli_real_escape_string($conn, file_get_contents($targetFile));
                $daftar = mysqli_query($conn, "update user set foto_user = '$foto' WHERE id_user = " . $_SESSION['id_user'] . "");
            } else {
                //echo "<script>alert('File is too large ( 5 Mb max )');location.href='update_user.php';</script>";
            }
        }
        if ($update) {
            //echo "<script>alert('Profil berhasil diperbarui');location.href='update_user.php';</script>";
        } else {
            //echo "<script>alert('Gagal memperbarui profil');location.href='update_user.php';</script>";
        }
    }
}
?>