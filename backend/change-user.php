<?php
session_start();
include("../database/config.php");

$id_kariyawan = $_POST['id'];
$nama_kariyawan = $_POST['nkariyawan'];
$kontak = $_POST['kontak'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if ($mysqli->query("UPDATE tb_kariyawan SET nama_kariyawan='$nama_kariyawan', kontak='$kontak', username='$username', password='$password', email='$email' WHERE id_kariyawan='$id_kariyawan'")) {
  header("Location:../admin/master-user.php");
} else {
  echo "gagal update";
}
?>
