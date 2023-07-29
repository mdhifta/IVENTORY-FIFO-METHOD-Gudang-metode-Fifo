<?php
session_start();

$row = $_GET['id'];
$_SESSION['jumlah'][$row]--;

if($_SESSION['jumlah'][$row] == 0){
  unset($_SESSION['jumlah'][$row]);
  unset($_SESSION['id_barang'][$row]);
  unset($_SESSION['harga'][$row]);
}

header('location:../add-penjualan.php');