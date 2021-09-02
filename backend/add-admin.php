<?php
include('../database/config.php');

$nama_admin = $_POST['nadmin'];
$username = $_POST['username'];
$password = $_POST['password'];
$hak = $_POST['hak'];
$email = $_POST['email'];
$telephone = $_POST['telp'];

$query = $mysqli->query("SELECT * FROM tb_admin WHERE username='$username'");
$selection = $query->num_rows;

$query2 = $mysqli->query("SELECT * FROM tb_admin WHERE email='$email'");
$selection2 = $query2->num_rows;

if ($selection!=1 || $selection2!=1) {
  if($mysqli->query("INSERT INTO tb_admin(nama_admin, no_handphone, username, password, email, level) VALUES('$nama_admin', '$telephone','$username', '$password', '$email','$hak')")) {
    header('Location:../admin/master-admin.php');
  } else {
    echo "query error";
  }
} else {
  header('Location:../admin/add-admin.php?id=1');
}
?>
