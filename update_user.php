<?php
include "header.php";
?>
<section class="vh-100 d-flex align-items-center justify-content-center">
  <div class="card p-3" style="width: 30rem">
    <div class="card-body">
      <div class="mx-auto" style="width: 10rem">
        <!-- MEMANGGIL VALUE DARI TABEL USER -->
        <?php
        $query_user = mysqli_query($conn, "select * from user where id_user = " . $_SESSION['id_user'] . "");
        $data_user = mysqli_fetch_array($query_user);
        ?>
        <img class="rounded" src="data:image/jpeg;base64,<?= base64_encode($data_user['foto_user']) ?>"
          alt="<?= $data_user['nama_user'] . "'s photo"; ?>" style="width: 10rem; height: 10rem;">
      </div>
      <p class="card-title text-center h3 mt-3">My Account</p>
      <div class="row row-cols-1 mt-3">
        <div class="col">
          <!-- -->
          <!-- FORM UPDATE USER -->
          <form action="proses_update.php" method="post" enctype="multipart/form-data">
            <label for="">Nama</label><br />
            <input class="w-100" type="text" name="nama" autocomplete="off"
              value="<?= $data_user['nama_user'] ?>" /><br />
            <label class="mt-3 d-flex justify-content-between" for=""><span>Jenis Kelamin</span><!--<span>
                <?= $data_user['jenis_kelamin'] ?>
              </span>--></label>
            <div class="border border-dark p-1 d-flex justify-content-between">
              <label for="">Laki-Laki</label>
              <input type="radio" name="jenis_kelamin" value="laki laki" <?php if ($data_user['jenis_kelamin'] === "laki laki")
                echo "checked"; ?> />
              <label for="">Perempuan</label>
              <input type="radio" name="jenis_kelamin" value="perempuan" <?php if ($data_user['jenis_kelamin'] === "perempuan")
                echo "checked"; ?> />
              <label for="">Buku Sidu</label>
              <input type="radio" name="jenis_kelamin" value="tidak ingin diketahui" <?php if ($data_user['jenis_kelamin'] === "tidak ingin diketahui")
                echo "checked"; ?> />
            </div>
            <label class="mt-3" for="">Email</label><br />
            <input class="w-100" type="email" name="email" autocomplete="off"
              value="<?= $data_user['email_user'] ?>" /><br />
            <label class="mt-3 d-flex justify-content-between"
              for=""><span>Password</span><!--<span>Generated with md5</span>--></label>
            <input class="w-100" type="password" name="password" /><br />
            <label class="mt-3" for="">Alamat</label><br />
            <input class="w-100" type="text" name="alamat" autocomplete="off"
              value="<?= $data_user['alamat_user'] ?>" /><br />
            <label class="mt-3" for="">Foto</label><br />
            <input class="w-100" type="file" name="foto" accept="image/*" /><br />
            <input class="mt-4 w-100 text-light border border-0 rounded" type="submit" value="Update"
              style="background-color: #e92329" />
          </form>
        </div>
        <div class="col mt-3">
          <div class="row">
            <div class="col">
              <p>
                <a class="text-dark" href="index.php">Back to home</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>