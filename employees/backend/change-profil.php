<?php
session_start();
include("../../database/config.php");

$id = $_SESSION['employee_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($mysqli->query("UPDATE tb_employees SET name='$name', phone='$phone', username='$username', password='$password' 
WHERE id='$id'")) {
  header("Location:../my-profil.php");
} else {
  echo "gagal update";
}
