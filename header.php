<?php
include "koneksi.php";
session_start();
if (!empty($_SESSION['id_user'])) {
    $_SESSION['status_login'] = true;
} else {
    $_SESSION['status_login'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <title>Moklet Merch</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <nav class="row px-5 py-2 d-flex align-items-center fixed-top text bg-light">
        <div class="col-2 d-flex justify-content-start">
            <img src="components/logo-moklet.png" alt="SMK Telkom Malang" class="img-fluid =" style="width: 12rem; padding:10px">
        </div>
        <div class="col d-flex justify-content-center align-items-center grid gap-5">
            <div class="dropdown">
                <button class="border-0 bg-light rounded dropdown-toggle h4" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Discovery
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item sub-text" href="index.php#produk">Product</a></li>
                    <li><a class="dropdown-item sub-text" href="history.php">History</a></li>
                </ul>
            </div>
            <button class="border-0 bg-light rounded h4"><a class="text-dark" href="about.php"
                    style="text-decoration:none;">About</a></button>
            <button class="border-0 bg-light rounded h4"><a class="text-dark" href="contact.php"
                    style="text-decoration:none;">Contact Us</a></button>
        </div>
        <div class="col-2 d-flex justify-content-end grid gap-5">
            <div class="dropdown">
                <img src="components/profile.png" alt="profile" class="img-fluid" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <ul class="dropdown-menu">
                    <?php
                    if ($_SESSION['status_login'] == true) {
                        echo '<li><a class="dropdown-item sub-text">' . $_SESSION['nama_user'] . '</a></li>';
                        echo '<li><a class="dropdown-item sub-text" href="update_user.php">Ubah Profil</a></li>';
                        echo '<li><a class="dropdown-item sub-text" href="logout.php">Logout</a></li>';
                    } else {
                        echo '<li><a class="dropdown-item sub-text" href="login.html">Login</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <?php
            if (!empty($_SESSION['id_user'])) {
                $query_notif = mysqli_query($conn, "SELECT * FROM transaksi t JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi WHERE t.id_user = " . $_SESSION['id_user'] . " AND t.id_transaksi IS NOT NULL AND t.status_pembayaran LIKE 'belum dibayar'");
                if (mysqli_num_rows($query_notif) > 0) {
                    ?>
                    <a href="keranjang.php"><img src="components/cart-notif.png" alt="cart" class="img-fluid"></a>
                    <?php
                } else {
                    ?>
                    <a href="keranjang.php"><img src="components/cart.png" alt="cart" class="img-fluid"></a>
                    <?php
                }
            } else {
                ?>
                <a href="keranjang.php"><img src="components/cart.png" alt="cart" class="img-fluid"></a>
                <?php
            }
            ?>
        </div>
    </nav>