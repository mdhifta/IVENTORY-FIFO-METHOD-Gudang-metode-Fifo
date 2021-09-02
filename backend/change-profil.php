<?php
session_start();
include("../database/config.php");

$id_admin = $_SESSION['id_admin'];
$nama_admin = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($mysqli->query("UPDATE tb_admin SET nama_admin='$nama_admin', username='$username', password='$password' WHERE id_admin='$id_admin'")) {
  header("Location:../admin/myprofil.php");
} else {
  echo "gagal update";
}
?>
