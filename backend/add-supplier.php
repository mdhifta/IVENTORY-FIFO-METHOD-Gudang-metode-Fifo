<?php
include('../database/config.php');

$nama_supplier = $_POST['nsupplier'];
$alamat_supplier = $_POST['alamat'];
$kontak_supplier = $_POST['kontak'];

if($mysqli->query("INSERT INTO tb_supplier(nama_supplier, alamat_supplier, kontak_supplier) VALUES('$nama_supplier', '$alamat_supplier', '$kontak_supplier')")) {
  header('Location:../admin/supplier.php');
} else {
  echo "query error";
}
?>
