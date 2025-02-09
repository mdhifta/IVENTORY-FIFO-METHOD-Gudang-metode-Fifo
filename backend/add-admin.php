<?php
include('../database/config.php');

$name = $_POST['name'];
$level = $_POST['level'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = $mysqli->query("SELECT * FROM tb_admin WHERE username='$username'");
$selection = $query->num_rows;

$query2 = $mysqli->query("SELECT * FROM tb_admin WHERE email='$email'");
$selection2 = $query2->num_rows;

if ($selection != 1 || $selection2 != 1) {
  if ($mysqli->query("INSERT INTO tb_admin(name, phone, username, password, email, level) VALUES('$name', '$phone','$username', '$password', '$email','$level')")) {
    header('Location:../admin/master-admin.php');
  } else {
    echo "query error";
  }
} else {
  header('Location:../admin/add-admin.php?id=1');
}
