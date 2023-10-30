<?php
include "koneksi.php";
session_start();
if ($_SESSION['status_login'] == false) {
    echo "<script>alert('Login Before Making A Transaction');location.href='login.php';</script>";
} elseif ($_POST['quantity'] < 1) {
    echo "<script>alert('Minimum Purchase Of 1 Item');location.href='transaction.php?id_merch=" . $_POST['id_merch'] . "';</script>";
} else {
    $query_user = mysqli_query($conn, "select * from user where id_user = " . $_SESSION['id_user'] . "");
    $data_user = mysqli_fetch_array($query_user);
    $query_detail_merch = mysqli_query($conn, "select * from merch where id_merch = " . $_POST['id_merch'] . "");
    $data_detail_merch = mysqli_fetch_array($query_detail_merch);
    date_default_timezone_set('Asia/Jakarta');
    $current_date = new DateTime();
    $formatted_time = $current_date->format('Y-m-d H:i:s');
    $query_transaksi = mysqli_query($conn, "insert into transaksi (id_user,tgl_pemesanan,status_pembayaran,total_harga,alamat) value ('" . $_SESSION['id_user'] . "','" . $formatted_time . "','belum dibayar','" . $data_detail_merch['harga_merch'] * $_POST['quantity'] . "','" . $data_user['alamat_user'] . "')");
    $id_transaksi = mysqli_insert_id($conn);
    $query_detail_transaksi = mysqli_query($conn, "insert into detail_transaksi (id_merch,id_transaksi,banyak_barang) value ('" . $_POST['id_merch'] . "','" . $id_transaksi . "','" . $_POST['quantity'] . "')");
    echo "<script>alert('Added To Cart');location.href='index.php#product';</script>";
}

?>