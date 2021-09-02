<?php
session_start();
include("../database/config.php");

$id_admin = $_POST['id'];
$nama_admin = $_POST['nadmin'];
$username = $_POST['username'];
$password = $_POST['password'];
$hak = $_POST['hak'];
$email = $_POST['email'];
$telephone = $_POST['telp'];

if ($mysqli->query("UPDATE tb_admin SET nama_admin='$nama_admin', no_handphone='$telephone', username='$username', password='$password', email='$email', level='$hak' WHERE id_admin='$id_admin'")) {
  header("Location:../admin/master-admin.php");
} else {
  echo "gagal update";
}
?>
