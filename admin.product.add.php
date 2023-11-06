<?php
include "koneksi.php";

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

$targetDirectory = "components/produk/";
if ($_FILES["foto"]["size"] <= (5 * 1024 * 1024)) {
    if (!empty($_FILES["foto"]) && !empty($nama) && !empty($stok) && !empty($harga)) {
        $targetFile = $targetDirectory . basename($nama);
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
            $foto = mysqli_real_escape_string($conn, file_get_contents($targetFile));
            $merch_query = "INSERT INTO merch (nama_merch, foto_merch, harga_merch, stok_merch) VALUES ('$nama', '$foto', '$harga', '$stok')";
            if (mysqli_query($conn, $merch_query)) {
                echo "<script>alert('New Product Inserted Successfuly');location.href='admin.php';</script>";
            } else {
                echo "<script>alert('Error Upload');location.href='admin.php';</script>";
            }
        } else {
            echo "<script>alert('Error Upload');location.href='admin.php';</script>";
        }
    } else {
        echo "<script>alert('Error Upload');location.href='admin.php';</script>";
    }
} else {
    echo "<script>alert('Error Upload');location.href='admin.php';</script>";
}


?>