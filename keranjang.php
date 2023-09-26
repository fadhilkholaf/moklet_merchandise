<?php
include "header.php";
$apacoba = false
    ?>
<section class="vh-100 pt-5">
    <h1 class="text-center mt-5">Your cart items</h1>
    <p class="text-center mt-5"><a href="index.php#produk" style="color:#B02228">Back to shopping</a></p>
    <div class="container mt-5 pt-5">
        <table class="table table-striped">
            <tr>
                <th class="col-6">Product</th>
                <th class="col-2">Price</th>
                <th class="col-2 text-center">Quantity</th>
                <th class="col-2 text-end">Total</th>
            </tr>
            <?php
            if ($_SESSION['status_login'] == true) {
                $query_keranjang = mysqli_query($conn, "select * from transaksi t join detail_transaksi dt on t.id_transaksi = dt.id_transaksi where t.id_user = " . $_SESSION['id_user'] . " AND t.status_pembayaran LIKE 'belum dibayar'");
                if (mysqli_num_rows($query_keranjang) > 0) {
                    $apacoba = true;
                }
                while ($data_keranjang = mysqli_fetch_array($query_keranjang)) {
                    $query_merch = mysqli_query($conn, "select * from merch where id_merch = " . $data_keranjang['id_merch'] . "");
                    $data_merch = mysqli_fetch_array($query_merch)
                        ?>
                    <tr>
                        <td class="col-6">
                            <div class="row grid gap-0 column-gap-3 py-3">
                                <div class="col-3">
                                    <img src="data:image/jpeg;base64,<?= base64_encode($data_merch['foto_merch']) ?>"
                                        alt="<?= $data_merch['nama_merch'] ?>" style="width: 10rem; height: 8rem;">
                                </div>
                                <div class="col">
                                    <h3>
                                        <?php echo $data_merch['nama_merch'] ?>
                                    </h3>
                                    <p class="pt-2">
                                        <a href="remove.php?id_transaksi=<?= $data_keranjang['id_transaksi'] ?>"
                                            style="color:#B02228">Remove</a>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="col-2" style="vertical-align: middle;">
                            <h6 style="color:#B02228">Rp.
                                <?php echo number_format($data_merch['harga_merch']) ?>
                            </h6>
                        </td>
                        <td class="col-2 text-center" style="vertical-align: middle;">
                            <h6 class="mx-auto p-1"
                                style="color:#B02228; width:5rem; height: 2rem; border: 1px solid #B02228; background-color:#ffffff; text-decoration:none; color:#B02228;">
                                <?php echo $data_keranjang['banyak_barang'] ?>
                            </h6>
                        </td>
                        <td class="col-2 text-end" style="vertical-align: middle;">
                            <h6 style="color:#B02228">Rp.
                                <?php echo number_format($data_keranjang['total_harga']) ?>
                            </h6>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <?php
        if ($apacoba == true) {
            ?>
            <div class="row justify-content-end">
                <div class="col-2">
                    <h6 class="text-center p-1 rounded"
                        style="background-color:#B02228; border: 1px solid #B02228; text-decoration:none;">
                        <a href="checkout.php" style="text-decoration:none; color: #ffffff;">Check-out All</a>
                    </h6>
                </div>
            </div>
            <?php
        }else{

        }
        ?>
    </div>
    <!-- -->
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>