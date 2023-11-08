<?php
include "header.php";
if ($_SESSION['status_login'] == false || $_SESSION['role'] == 'member') {
  echo "<script>location.href='index.php';</script>";
}
?>
<section class="pt-5 vh-100">
  <h1 class="mt-5 text-center">Product</h1>
  <div class="row row-cols-2 m-0 d-flex justify-content-between">
    <div class="mt-5 col">
      <p class="ms-5">Add Product</p>
      <form class="px-5" action="admin.product.add.php" method="post" enctype="multipart/form-data">
        <label for="">Name</label><br />
        <input class="w-100" type="text" name="nama" autocomplete="off" /><br />
        <label for="">Stock</label><br />
        <input class="w-100" type="number" name="stok" autocomplete="off" /><br />
        <label for="">Price</label><br />
        <input class="w-100" type="number" name="harga" autocomplete="off" /><br />
        <label class="mt-3" for="">Foto</label><br />
        <input class="w-100" type="file" name="foto" accept="image/*" /><br />
        <input class="mt-4 w-100 text-light border border-0 rounded" type="submit" value="Add product"
          style="background-color: #e92329" />
      </form>
    </div>
    <div class="mt-5 col">
      <p>Edit Product</p>
      <div class="row row-cols-2 d-flex justify-content-between">
        <?php
        $nama = '';
        $stok = '';
        $harga = '';
        $id = null;
        if ($_GET) {
          $query_merch_edit = mysqli_query($conn, "select * from merch where id_merch = " . $_GET['id_merch'] . "");
          $data_merch_edit = mysqli_fetch_array($query_merch_edit);
          $nama = $data_merch_edit['nama_merch'];
          $stok = $data_merch_edit['stok_merch'];
          $harga = $data_merch_edit['harga_merch'];
          $id = $_GET['id_merch'];
        }
        ?>
        <a href="admin.php" class="col col-4 p-0">
          <img class="rounded shadow p-0"
            src="data:image/jpeg;base64,<?= base64_encode($data_merch_edit['foto_merch']) ?>"
            alt="Select Product To Edit" style="width: 18rem; height: 18rem;">
        </a>
        <form class="px-5 col col-8" action="admin.product.edit.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_merch" value="<?= $id ?>">
          <label for="">Name</label><br />
          <input class="w-100" type="text" name="nama" value="<?= $nama ?>" autocomplete="off" /><br />
          <label for="">Stock</label><br />
          <input class="w-100" type="number" name="stok" value="<?= $stok ?>" autocomplete="off" /><br />
          <label for="">Price</label><br />
          <input class="w-100" type="number" name="harga" value="<?= $harga ?>" autocomplete="off" /><br />
          <label class="mt-3" for="">Foto</label><br />
          <input class="w-100" type="file" name="foto" accept="image/*" /><br />
          <div class="d-flex grid gap-0 column-gap-5">
            <input class="mt-4 w-100 text-light border border-0 rounded" type="submit" value="Edit product"
              style="background-color: #e92329" />
            <a href="admin.product.delete.php?id_merch=<?= $id ?>"
              class="text-center mt-4 w-100 text-light border border-0 rounded"
              style="background-color: #e92329; text-decoration:none;">Delete
              Product</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <p class="ms-5 mt-5 ps-3">Click To Edit</p>
  <div class="d-flex justify-content-center">
    <div class="mx-5 m-0 py-3 row row-cols-lg-6 d-flex grid gap-0 row-gap-5"
      style="width:100%;height: 35vh; overflow-y: scroll;">
      <?php
      $query_merch = mysqli_query($conn, "SELECT * FROM merch ORDER BY stok_merch DESC");
      while ($data_merch = mysqli_fetch_array($query_merch)) {
        ?>
        <a href="admin.php?id_merch=<?= $data_merch['id_merch'] ?>" style="text-decoration:none;">
          <div class="col">
            <div class="card border shadow rounded" style="width: 17rem;">
              <div class="position-absolute m-3">
                <p class="bg-light text-danger rounded p-1">
                  Stock :
                  <?= $data_merch['stok_merch'] ?>
                </p>
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
<section id="user" class="pt-5 vh-100">
  <h1 class="mt-5 text-center">User</h1>
  <div class="container">
    <table class="table table-striped mt-5">
      <tr class="position-sticky top-0">
        <th class="col">Id</th>
        <th class="col">Name</th>
        <th class="col">Email</th>
        <th class="col" colspan="2">Role</th>
      </tr>
      <?php
      $query_user = mysqli_query($conn, "select * from user where id_user not like " . $_SESSION['id_user'] . " order by id_user asc");
      while ($data_user = mysqli_fetch_array($query_user)) {
        ?>
        <tr>
          <td class="col" style="vertical-align: middle;">
            <?= $data_user['id_user'] ?>
          </td>
          <td class="col" style="vertical-align: middle;">
            <?= $data_user['nama_user'] ?>
          </td>
          <td class="col" style="vertical-align: middle;">
            <?= $data_user['email_user'] ?>
          </td>
          <td class="col" style="vertical-align: middle;">
            <?= $data_user['role'] ?>
          </td>
          <td>
            <a href="admin.user.delete.php?id_user=<?= $data_user['id_user'] ?>" type="button" class="btn btn-outline-danger float-end ms-2" onclick="return confirm('Delete user <?= $data_user['nama_user'] ?> ?')" >Delete</a>
            <a href="admin.user.edit.php?id_user=<?= $data_user['id_user'] ?>&role=<?= $data_user['role'] ?>"
              type="button" class="btn btn-outline-warning float-end"
              onclick="return confirm('Update role to <?= $data_user['role'] == 'member' ? 'admin' : 'member'; ?> ?')">Update</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>