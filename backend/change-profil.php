<?php
session_start();
include("../database/config.php");

$id = $_SESSION['admin_id'];
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($mysqli->query("UPDATE tb_admin SET name='$name', username='$username', password='$password' WHERE id='$id'")) {
  header("Location:../admin/my-profil.php");
} else {
  echo "gagal update";
}
