<?php
include "header.php";
$query_detail_transaksi = mysqli_query($conn, "select * from detail_transaksi where id_transaksi = " . $_GET['id_transaksi'] . "");
$data_detail_transaksi = mysqli_fetch_array($query_detail_transaksi);
$query_merch = mysqli_query($conn, "select * from merch where id_merch = " . $data_detail_transaksi['id_merch'] . "");
$data_merch = mysqli_fetch_array($query_merch);
?>
<section class="vh-100 d-flex align-items-center">
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($data_merch['foto_merch']) ?>"
                        alt="<?php echo $data_merch['nama_merch'] ?>" style="width: 33rem; height: 33rem;">>
                </div>
                <div class="col d-flex align-items-center">
                    <form action="cart.edit.process.php" method="post">
                        <div class="row row-cols-1 grid gap-0 row-gap-5">
                            <div class="col">
                                <h3>
                                    <?php echo $data_merch['nama_merch'] ?>
                                </h3>
                            </div>
                            <div class="col">
                                <p style="color:#B02228">Rp.
                                    <?php echo number_format($data_merch['harga_merch']) ?>
                                </p>
                            </div>
                            <div class="col">
                                <label class="text-center" for="" style="width:100px;">Quantity</label><br>
                                <input class="text-center" type="number" name="quantity"
                                    value="<?= $data_detail_transaksi['banyak_barang'] ?>"
                                    style="width:100px; border: 1px solid #B02228;">
                            </div>
                            <div class="col">
                                <div class="d-grid">
                                    <input class="opacity-0" type="number" name="id_transaksi"
                                        value="<?= $data_detail_transaksi['id_transaksi'] ?>">
                                    <input type="hidden" name="id_merch"
                                        value="<?= $data_detail_transaksi['id_merch'] ?>">
                                    <input class="text-center" type="submit" value="Update"
                                        style="border: 1px solid #B02228; background-color:#ffffff; text-decoration:none; color:#B02228">
                                </div>
                            </div>
                            <p><a href="cart.php" style="color:#B02228">Back to
                                    cart</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>