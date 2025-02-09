<?php
include('../database/config.php');

$id = $_GET['id'];

if ($mysqli->query("DELETE FROM tb_employees WHERE id='$id'")) {
  header("Location:../admin/master-user.php");
} else {
  echo "gagal menghapus!";
}
