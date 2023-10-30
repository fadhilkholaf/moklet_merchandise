<?php
include "koneksi.php";
session_start();
date_default_timezone_set('Asia/Jakarta');
$current_date = new DateTime();
$formatted_time = $current_date->format('Y-m-d H:i:s');
if ($_GET['checkout'] == "single") {
    $query_detail_transaksi = mysqli_query($conn, "select * from detail_transaksi where id_transaksi = " . $_GET['id_transaksi'] . "");
    $data_detail_transaksi = mysqli_fetch_array($query_detail_transaksi);
    $query_merch = mysqli_query($conn, "select * from merch where id_merch = " . $data_detail_transaksi['id_merch'] . "");
    $data_merch = mysqli_fetch_array($query_merch);
    mysqli_query($conn, "UPDATE `merch` SET `stok_merch`='" . $data_merch['stok_merch'] - $data_detail_transaksi['banyak_barang'] . "' WHERE id_merch = " . $data_detail_transaksi['id_merch'] . "");
    mysqli_query($conn, "update transaksi set status_pembayaran = 'sudah dibayar', tgl_pembayaran = '" . $formatted_time . "' where id_transaksi = " . $_GET['id_transaksi'] . "");
    echo "<script>alert('Checkout Successfuly');location.href='cart.php';</script>";
} else {
    $query_transaksi = mysqli_query($conn, "select distinct id_merch from detail_transaksi where id_transaksi in (select id_transaksi from transaksi where id_user = " . $_SESSION['id_user'] . " and status_pembayaran = 'belum dibayar')");
    while ($data_transaksi = mysqli_fetch_array($query_transaksi)) {
        $query_detail_transaksi = mysqli_query($conn, "select sum(banyak_barang) as banyak_barang from detail_transaksi dt join transaksi t on dt.id_transaksi = t.id_transaksi where dt.id_merch = " . $data_transaksi['id_merch'] . " and t.status_pembayaran = 'belum dibayar' and t.id_user = " . $_SESSION['id_user'] . "");
        $data_detail_transaksi = mysqli_fetch_array($query_detail_transaksi);
        $query_merch = mysqli_query($conn, "select * from merch where id_merch = " . $data_transaksi['id_merch'] . "");
        $data_merch = mysqli_fetch_array($query_merch);
        mysqli_query($conn, "UPDATE `merch` SET `stok_merch`='" . $data_merch['stok_merch'] - $data_detail_transaksi['banyak_barang'] . "' WHERE id_merch = " . $data_transaksi['id_merch'] . "");
    }
    mysqli_query($conn, "update transaksi set status_pembayaran = 'sudah dibayar', tgl_pembayaran = '" . $formatted_time . "' where id_user = " . $_SESSION['id_user'] . " and status_pembayaran = 'belum dibayar'");
    echo "<script>alert('Checkout Successfuly');location.href='cart.php';</script>";
}
//AKU BINGONG
//     A
//    A A
//   A   A    K
//  A A A A   K
// A       A  K
//A         A K
//README.md
?>