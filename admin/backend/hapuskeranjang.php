<?php
session_start();

$num_array = $_GET['id'];
// unset($_SESSION['keranjang'][$id_produk]);

$_SESSION['jumlah'][$num_array]--;

if($_SESSION['jumlah'][$num_array] == 0){
  unset($_SESSION['id_barang'][$num_array]);
  unset($_SESSION['jumlah'][$num_array]);
  unset($_SESSION['harga'][$num_array]);
}

header('location:../add-pembelian.php');
