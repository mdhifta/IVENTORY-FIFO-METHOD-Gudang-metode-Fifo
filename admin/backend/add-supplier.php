<?php
session_start();

if (isset($_POST['id_supplier'])) {
  $_SESSION['id_supplier'] = $_POST['id_supplier'];
  $_SESSION['id_barang'] = array();
  $_SESSION['jumlah'] = array();
  $_SESSION['harga'] = array();

  header('Location:../add-pembelian.php');
}

 ?>
