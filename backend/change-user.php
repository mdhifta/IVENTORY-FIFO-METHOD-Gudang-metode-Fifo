<?php
session_start();
include("../database/config.php");

$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if ($mysqli->query("UPDATE tb_employees SET name='$name', phone='$phone', username='$username', password='$password', email='$email' WHERE id='$id'")) {
  header("Location:../admin/master-user.php");
} else {
  echo "gagal update";
}
