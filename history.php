<?php
include "header.php";
?>

<section id="history" class="vh-100 pt-5">
    <h1 class="text-center mt-5">Your history</h1>
    <p class="text-center mt-5"><a href="index.php#product" style="color:#B02228">Back to shopping</a></p>
    <div class="container mt-5"  style="height: 70vh; overflow-y: scroll;">
        <table class="table table-striped">
            <tr class="position-sticky top-0">
                <th class="col">Product</th>
                <th class="col">Name</th>
                <th class="col">Order date</th>
                <th class="col">Payment date</th>
                <th class="col">Quantity</th>
                <th class="col">Total price</th>
            </tr>
            <?php
            if ($_SESSION['status_login'] == true) {
                $query_transaksi = mysqli_query($conn, "SELECT * FROM transaksi t 
            JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi 
            WHERE t.id_user = " . $_SESSION['id_user'] . " 
            AND t.status_pembayaran LIKE 'sudah dibayar'
            ORDER BY t.tgl_pemesanan DESC");
                while ($data_transaksi = mysqli_fetch_array($query_transaksi)) {
                    $query_merch = mysqli_query($conn, "SELECT * FROM merch 
                WHERE id_merch IN (SELECT id_merch FROM detail_transaksi dt, transaksi t 
                WHERE dt.id_transaksi = " . $data_transaksi['id_transaksi'] . " 
                AND t.id_user = " . $_SESSION['id_user'] . ")");
                    $data_merch = mysqli_fetch_array($query_merch)
                        ?>
                    <tr>
                        <td class="d-flex align-items-center grid gap-0 column-gap-3 col">
                            <img src="data:image/jpeg;base64,<?= base64_encode($data_merch['foto_merch']) ?>"
                                alt="<?= $data_merch['nama_merch'] ?>" style="width: 10rem; height: 8rem;">
                        </td>
                        <td class="col" style="vertical-align: middle;">
                            <?php echo $data_merch['nama_merch'] ?>
                        </td>
                        <td class="col" style="vertical-align: middle;">
                            <?= $data_transaksi['tgl_pemesanan'] ?>
                        </td>
                        <td class="col" style="vertical-align: middle;">
                            <?= $data_transaksi['tgl_pembayaran'] ?>
                        </td>
                        <td class="col" style="vertical-align: middle;">
                            <?= $data_transaksi['banyak_barang'] ?>
                        </td>
                        <td class="col" style="vertical-align: middle;">Rp.
                            <?= number_format($data_transaksi['total_harga']) ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>