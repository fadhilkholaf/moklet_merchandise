<?php
include "koneksi.php";
$query_remove = mysqli_query($conn,"DELETE FROM transaksi WHERE id_transaksi = ".$_GET['id_transaksi']."");
$query_detail_remove = mysqli_query($conn,"DELETE FROM detail_transaksi WHERE id_transaksi = ".$_GET['id_transaksi']."");
echo "<script>alert('Removed Successfuly');location.href='cart.php';</script>";
?>