<?php
  include('../database/config.php');
  $id = $_GET['id'];
  if ($mysqli->query("DELETE FROM tb_kariyawan WHERE id_kariyawan='$id'")) {
    header("Location:../admin/master-user.php");
  } else {
    echo "gagal menghapus!";
  }
 ?>
