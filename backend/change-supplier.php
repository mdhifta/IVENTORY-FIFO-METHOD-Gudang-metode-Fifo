<?php
include('../database/config.php');

$nama_supplier = $_POST['nsupplier'];
$alamat_supplier = $_POST['alamat'];
$kontak_supplier = $_POST['kontak'];
$id = $_POST['id'];

if($mysqli->query("UPDATE tb_supplier SET nama_supplier = '$nama_supplier', alamat_supplier = '$alamat_supplier', kontak_supplier= '$kontak_supplier' WHERE id_supplier='$id'")) {
  header('Location:../admin/supplier.php');
} else {
  echo "query error";
}
?>
