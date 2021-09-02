<?php
include('../database/config.php');

$nama_brg = $_POST['nbarang'];
$satuan = $_POST['satuan'];
$id = $_POST['id'];

if($mysqli->query("UPDATE tb_barang SET nama_brg='$nama_brg', satuan='$satuan' WHERE id_barang='$id'")) {
  header('Location:../admin/master-item.php');
} else {
  echo "query error";
}
?>
