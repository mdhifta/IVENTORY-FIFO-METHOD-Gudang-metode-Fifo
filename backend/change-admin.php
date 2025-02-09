<?php
session_start();
include("../database/config.php");

$id = $_POST['id'];
$name = $_POST['name'];
$level = $_POST['level'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$username = $_POST['username'];

if ($mysqli->query("UPDATE tb_admin SET name='$name', phone='$phone', username='$username', password='$password', email='$email', level='$level' WHERE id='$id'")) {
  header("Location:../admin/master-admin.php");
} else {
  echo "gagal update";
}
