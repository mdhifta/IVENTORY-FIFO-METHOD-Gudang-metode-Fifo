<?php
include('../database/config.php');

$id = $_GET['id'];
if ($mysqli->query("DELETE FROM tb_admin WHERE id='$id'")) {
  header("Location:../admin/master-admin.php");
} else {
  echo "gagal menghapus!";
}
