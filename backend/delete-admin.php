<?php
  include('../database/config.php');
  $id = $_GET['id'];
  if ($mysqli->query("DELETE FROM tb_admin WHERE id_admin='$id'")) {
    header("Location:../admin/master-admin.php");
  } else {
    echo "gagal menghapus!";
  }
 ?>
