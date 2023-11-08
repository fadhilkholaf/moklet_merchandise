<?php
include "koneksi.php";
session_start();
if ($_SESSION['role'] == 'member' || empty($_SESSION['id_user'])) {
    echo "<script>location.href='index.php';</script>";
} else {
    mysqli_query($conn, "delete from user where id_user = " . $_GET['id_user'] . "");
    unlink("components/profile/" . $_GET['id_user'] . "");
    header("location:admin.php#user");
    exit();
}
?>