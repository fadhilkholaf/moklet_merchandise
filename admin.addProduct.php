<?php
include "koneksi.php";

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Handle image upload
$targetDirectory = "components/produk/"; // Specify the directory where you want to store uploaded images
// Check the uploaded file size
if ($_FILES["foto"]["size"] <= (5 * 1024 * 1024)) { // 2 MB in bytes (2 * 1024 * 1024)
    // Proceed with the upload and database insertion
    if (isset($_FILES["foto"])) {
        $targetFile = $targetDirectory . basename($_FILES["foto"]["name"]);
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully, insert data into the database
            $foto = mysqli_real_escape_string($conn, file_get_contents($targetFile));

            // Insert data into the database
            $merch_query = "INSERT INTO merch (nama_merch, foto_merch, harga_merch, stok_merch) VALUES ('$nama', '$foto', '$harga', '$stok')";

            if (mysqli_query($conn, $merch_query)) {
                echo "Merchandise data and image uploaded successfully.";
            } else {
                echo "Error inserting data into the database: " . mysqli_error($conn);
            }
        } else {
            echo "Error moving the uploaded image to the target directory.";
        }
    } else {
        echo "No file was uploaded.";
    }
} else {
    echo "File is too large. Maximum file size is 2 MB.";
}


?>