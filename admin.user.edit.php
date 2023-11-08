<?php
include "koneksi.php";
$role = $_GET['role'] == 'admin' ? 'member' : 'admin';
mysqli_query($conn, "update user set role = '" . $role . "' where id_user = " . $_GET['id_user'] . "");
header("location:admin.php#user");
exit();
?>