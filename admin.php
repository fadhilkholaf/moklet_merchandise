<?php
include "header.php";
if ($_SESSION['status_login'] == false || $_SESSION['role'] == 'member') {
  echo "<script>location.href='index.php';</script>";
  exit();
}
?>
<section class="vh-100 mt-5 pt-5">
  <form action="admin.addProduct.php" method="post" enctype="multipart/form-data">
    <label for="">Nama</label>
    <input type="text" name="nama" /><br />

    <label for="">Foto</label>
    <input type="file" accept="image/*" name="foto" /><br />

    <label for="">Harga</label>
    <input type="text" name="harga" /><br />

    <label for="">Stok</label>
    <input type="text" name="stok" /><br />

    <input type="submit" value="Submit" />
  </form>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>