<?php
include "koneksi.php";
session_start();
date_default_timezone_set('Asia/Jakarta');
$current_date = new DateTime();
$formatted_time = $current_date->format('Y-m-d H:i:s');
$query_user = mysqli_query($conn, "select * from user where id_user = " . $_SESSION['id_user'] . "");
$data_user = mysqli_fetch_array($query_user);
$resf = "";
$ress = "";
if ($_GET['checkout'] == "single") {
    $query_detail_transaksi = mysqli_query($conn, "select * from detail_transaksi dt join transaksi t on dt.id_transaksi = t.id_transaksi where dt.id_transaksi = " . $_GET['id_transaksi'] . "");
    $data_detail_transaksi = mysqli_fetch_array($query_detail_transaksi);
    $query_merch = mysqli_query($conn, "select * from merch where id_merch = " . $data_detail_transaksi['id_merch'] . "");
    $data_merch = mysqli_fetch_array($query_merch);
    if ($data_detail_transaksi['banyak_barang'] > $data_merch['stok_merch'] || $data_detail_transaksi['total_harga'] > $data_user['saldo']) {
        $resf = $resf . $data_merch['nama_merch'] . ", ";
    } else {
        mysqli_query($conn, "UPDATE `merch` SET `stok_merch`='" . $data_merch['stok_merch'] - $data_detail_transaksi['banyak_barang'] . "' WHERE id_merch = " . $data_detail_transaksi['id_merch'] . "");
        mysqli_query($conn, "UPDATE `user` SET `saldo`='" . $data_user['saldo'] - $data_detail_transaksi['total_harga'] . "' WHERE id_user = " . $_SESSION['id_user'] . "");
        mysqli_query($conn, "update transaksi set status_pembayaran = 'sudah dibayar', tgl_pembayaran = '" . $formatted_time . "' where id_transaksi = " . $data_detail_transaksi['id_transaksi'] . "");
        $ress = $ress . $data_merch['nama_merch'] . ", ";
    }
} else {
    $query_detail_transaksi = mysqli_query($conn, "select * from detail_transaksi dt join transaksi t on dt.id_transaksi = t.id_transaksi where t.id_user = " . $_SESSION['id_user'] . " and t.status_pembayaran = 'belum dibayar'");
    while ($data_detail_transaksi = mysqli_fetch_array($query_detail_transaksi)) {
        $query_merch = mysqli_query($conn, "select * from merch where id_merch = " . $data_detail_transaksi['id_merch'] . "");
        $data_merch = mysqli_fetch_array($query_merch);
        if ($data_detail_transaksi['banyak_barang'] > $data_merch['stok_merch'] || $data_detail_transaksi['total_harga'] > $data_user['saldo']) {
            $resf = $resf . $data_merch['nama_merch'] . ", ";
        } else {
            mysqli_query($conn, "UPDATE `merch` SET `stok_merch`='" . $data_merch['stok_merch'] - $data_detail_transaksi['banyak_barang'] . "' WHERE id_merch = " . $data_detail_transaksi['id_merch'] . "");
            mysqli_query($conn, "UPDATE `user` SET `saldo`='" . $data_user['saldo'] - $data_detail_transaksi['total_harga'] . "' WHERE id_user = " . $_SESSION['id_user'] . "");
            mysqli_query($conn, "update transaksi set status_pembayaran = 'sudah dibayar', tgl_pembayaran = '" . $formatted_time . "' where id_transaksi = " . $data_detail_transaksi['id_transaksi'] . "");
            $ress = $ress . $data_merch['nama_merch'] . ", ";
        }
    }
}
if (empty($ress)) {
    $res = "Failed Checkout " . $resf;
} elseif (empty($resf)) {
    $res = "Success Checkout " . $ress;
} else {
    $res = "Failed Checkout " . $resf . "Success Checkout " . $ress;
}
echo "<script>alert('$res');location.href='cart.php';</script>";
?>