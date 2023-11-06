<?php
include "koneksi.php";

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

if (empty($nama) || empty($stok) || empty($harga) || empty($_FILES["foto"])) {
    echo "<script>alert('Invalid Inserting Product, Please Fill All The Fields');location.href='admin.php';</script>";
} else {
    if ($_FILES["foto"]["size"] < (5 * 1024 * 1024)) {
        $daftar = mysqli_query($conn, "INSERT INTO merch (nama_merch, harga_merch, stok_merch) VALUES ('$nama', '$harga', '$stok')");
        $dir = "components/produk/";
        $targetFile = $dir . basename(mysqli_insert_id($conn));
        move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
        $foto = mysqli_real_escape_string($conn, file_get_contents($targetFile));
        mysqli_query($conn, "update merch set foto_merch = '$foto' WHERE id_merch = " . mysqli_insert_id($conn) . "");
        if ($daftar) {
            echo "<script>alert('Product Have Been Inserted');location.href='admin.php';</script>";
        } else {
            echo "<script>alert('Invalid Inserting Product');location.href='admin.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid File (5MB Max)');location.href='admin.php';</script>";
    }
}

?>