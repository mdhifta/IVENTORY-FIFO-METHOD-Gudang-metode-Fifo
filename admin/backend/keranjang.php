<?php
session_start();
include("../../database/config.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  $id = $_POST['id_barang'];
}

foreach ($_SESSION['id_barang'] as $num_array => $id_barang) {
  if ($num_array==$id) {
    $_SESSION['jumlah'][$num_array]+=1;
    $cek = 1;
    break;
  } else {
    $cek = 0;
  }
}

if ($cek==0) {
  array_push($_SESSION['id_barang'], $_POST['id_barang']);
  array_push($_SESSION['jumlah'], $_POST['jumlah']);
  array_push($_SESSION['harga'], $_POST['harga']);
  echo "disini";
  header("Location:../add-pembelian.php");
} else {
  header("Location:../add-pembelian.php");
}

?>
