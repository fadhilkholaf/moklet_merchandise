<?php
include "koneksi.php";

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

//EKSEKUSI PROSES UPDATE
if (empty($nama) || empty($harga) || empty($stok)) {
    echo "<script>alert('Invalid Updating Product, Please Fill All The Fields');location.href='admin.php?id_merch=" . $_POST['id_merch'] . "';</script>";
} else {
    $update = mysqli_query($conn, "UPDATE `merch` SET `nama_merch`='$nama',`harga_merch`='$harga',`stok_merch`='$stok' WHERE id_merch = " . $_POST['id_merch'] . "");

    //FOTO UPDATE
    $dir = "components/produk/";
    if (!empty($_FILES["foto"]) && $_FILES["foto"]["size"] < (5 * 1024 * 1024)) {
        $targetFile = $dir . basename($_POST['id_merch']);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
        $foto = mysqli_real_escape_string($conn, file_get_contents($targetFile));
        mysqli_query($conn, "UPDATE `merch` SET `foto_merch`='$foto' WHERE id_merch = " . $_POST['id_merch'] . "");
    } else {
        echo "<script>alert('Invalid File (5MB Max)');location.href='admin.php?id_merch=" . $_POST['id_merch'] . "';</script>";
    }

}
if ($update) {
    echo "<script>alert('Product Have Been Updated');location.href='admin.php?id_merch=" . $_POST['id_merch'] . "';</script>";
} else {
    echo "<script>alert('Invalid Updating Product');location.href='admin.php?id_merch=" . $_POST['id_merch'] . "';</script>";
}


?>