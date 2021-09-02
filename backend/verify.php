<?php
session_start();
include('../database/config.php');

$username = $_POST['username'];
$password = $_POST['password'];

#seleksi admin
$query_admin = $mysqli->query("SELECT * FROM tb_admin WHERE username='$username' AND password='$password'");
$admin = $query_admin->num_rows;

#seleksi kariyawan
$query_kariyawan = $mysqli->query("SELECT * FROM tb_kariyawan WHERE username='$username' AND password='$password'");
$kariyawan = $query_kariyawan->num_rows;

echo $admin;
if ($admin==1) {
  $data = $query_admin->fetch_object();
  $_SESSION['id_admin'] = $data->id_admin;
  $kariyawan = 1;
  header('Location:../admin/dashboard.php');
} else {
  $data = $query_kariyawan->fetch_object();
  $_SESSION['id_kariyawan'] = $data->id_kariyawan;
  $_SESSION['id_barang'] = array();
  $_SESSION['jumlah'] = array();
  $_SESSION['harga'] = array();
  $admin = 1;
  header('Location:../kariyawan/dashboard.php');
}

if ($admin==0) {
  header("Location:../index.php?id=1");
} elseif ($kariyawan==0) {
  header("Location:../index.php?id=1");
}
?>
