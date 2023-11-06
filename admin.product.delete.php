<?php
include "koneksi.php";
session_start();
if ($_SESSION['role'] == 'member' || empty($_SESSION['id_user'])) {
    echo "<script>location.href='index.php';</script>";
} elseif (empty($_GET['id_merch'])) {
    echo "<script>alert('Select The Product To Delete');location.href='admin.php';</script>";
} else {
    mysqli_query($conn, "delete from merch where id_merch = " . $_GET['id_merch'] . "");
    unlink("components/produk/" . $_GET['id_merch'] . "");
    echo "<script>alert('Product Deleted Successfuly');location.href='admin.php';</script>";
}
?>