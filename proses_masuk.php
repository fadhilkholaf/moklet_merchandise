<?php
include "koneksi.php";
$email = $_POST['email'];
$password = $_POST['password'];
if(!empty($email)||!empty($password)){
    $query_masuk = mysqli_query($conn,"select * from user where email_user like '$email' and password_user like '".md5($password)."'");
    if(mysqli_num_rows($query_masuk)>0){
        $data_user = mysqli_fetch_array($query_masuk);
        session_start();
        $_SESSION['id_user'] = $data_user['id_user'];
        $_SESSION['nama_user'] = $data_user['nama_user'];
        header('location: index.php');
    }else{
        echo "<script>alert('User tidak ditemukan');location.href='login.html';</script>";
    }
}else{
    echo "<script>alert('Data tidak boleh kosong');location.href='login.html';</script>";
}
?>