<?php
include "koneksi.php";
session_start();
$query_merch = mysqli_query($conn, "select * from merch where id_merch = (select id_merch from detail_transaksi where id_transaksi = " . $_POST['id_transaksi'] . ")");
$data_merch = mysqli_fetch_array($query_merch);
if ($_POST['quantity'] < 1) {
    echo "<script>alert('Minimum Purchase Of 1 Item');location.href='cart.edit.php?id_transaksi=" . $_POST['id_transaksi'] . "';</script>";
} elseif ($_POST['quantity'] > $data_merch['stok_merch']) {
    echo "<script>alert('Out Of Stock');location.href='cart.edit.php?id_transaksi=" . $_POST['id_transaksi'] . "';</script>";
} else {
    $query_merch = mysqli_query($conn, "select * from merch where id_merch = " . $_POST['id_merch'] . "");
    $data_merch = mysqli_fetch_array($query_merch);
    $query_update_detail_transaksi = mysqli_query($conn, "UPDATE `detail_transaksi` SET `banyak_barang`='" . $_POST['quantity'] . "' WHERE id_transaksi = " . $_POST['id_transaksi'] . "");
    $query_update_transaksi = mysqli_query($conn, "UPDATE `transaksi` SET `total_harga`='" . $data_merch['harga_merch'] * $_POST['quantity'] . "' WHERE id_transaksi = " . $_POST['id_transaksi'] . "");
    echo "<script>alert('Edited Successfuly');location.href='cart.php';</script>";
}
?>