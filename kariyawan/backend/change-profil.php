<?php
session_start();
include("../../database/config.php");
$id_kariyawan = $_SESSION['id_kariyawan'];
$nama_kariyawan = $_POST['nama'];
$kontak = $_POST['kontak'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($mysqli->query("UPDATE tb_kariyawan SET nama_kariyawan='$nama_kariyawan', kontak='$kontak', username='$username', password='$password' WHERE id_kariyawan='$id_kariyawan'")) {
  header("Location:../myprofil.php");
} else {
  echo "gagal update";
}
?>
