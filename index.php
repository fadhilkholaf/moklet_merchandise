<?php
include "header.php";
?>
<section id="home" class="vh-100 pt-auto d-flex justify-content-center align-items-center">
    <div class="card text-center mb-3 z-1 position-absolute"
        style="width: 40rem; height: 20rem; border-radius: 0.125rem; background: rgba(247, 248, 250, 0.65); backdrop-filter: blur(3.5px);">
        <div class="card-body d-flex justify-content-center align-items-center">
            <div>
                <h1 class="card-title"><span>Official Merchandise of</span><br>
                    <span>SMK Telkom Malang</span>
                </h1>
                <a href="#product" class="btn btn-primary rounded" style="background: #B02228;">Discover our
                    collection</a>
            </div>

        </div>
    </div>
    <img src="components/header-img.png" alt="Moklet Merch" class="img-fluid z-0 position-absolute">
</section>

<section id="product" class="vh-100 pt-5">
    <h1 class="text-center mt-5">Product</h1>
    <p class="text-center">Grab it fast!</p>
    <div class="container mt-5">
        <div class="py-3 row row-cols-lg-4 d-flex justify-content-center grid gap-0 row-gap-5"
            style="height: 70vh; overflow-y: scroll;">
            <?php
            $query_merch = mysqli_query($conn, "SELECT * FROM merch ORDER BY stok_merch DESC");
            while ($data_merch = mysqli_fetch_array($query_merch)) {
                ?>
                <a <?= $data_merch['stok_merch'] <= 0 ? "onclick=\"alert('Out Of Stock')\"" : "href=\"transaction.php?id_merch=" . $data_merch['id_merch'] . "\"" ?> style="text-decoration:none;">
                    <div class="col">
                        <div class="card border shadow rounded"
                            style="width: 17rem; <?= $data_merch['stok_merch'] <= 0 ? "filter:brightness(50%)" : ""; ?>">
                            <div class="position-absolute m-3">
                                <?php
                                if ($data_merch['stok_merch'] <= 0) { ?>
                                    <p class="bg-warning rounded p-1">Out Of Stock</p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="bg-warning rounded p-1">
                                        <?= $data_merch['stok_merch'] ?> Available
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                            <img class="align-self-center mt-2 shadow rounded"
                                src="data:image/jpeg;base64,<?= base64_encode($data_merch['foto_merch']) ?>"
                                alt="<?= $data_merch['nama_merch'] ?>" style="width: 16rem; height: 13.5rem;">
                            <div class="card-body">
                                <h6 class="card-text">
                                    <?= $data_merch['nama_merch'] ?>
                                </h6>
                                <h6 class="card-text text-end" style="color:#B02228">Rp.
                                    <?= number_format($data_merch['harga_merch']) ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="components/main.js"></script>
</body>

</html>