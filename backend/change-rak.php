<?php
include('../database/config.php');

$nama_rak = $_POST['nama_rak'];
$deskripsi_rak = $_POST['deskripsi_rak'];
$id = $_POST['id'];

if($mysqli->query("UPDATE tb_rak_barang SET nama_rak = '$nama_rak', deskripsi_rak = '$deskripsi_rak' WHERE id_rak_barang ='$id'")) {
  header('Location:../admin/rak-barang.php');
} else {
  echo "query error";
}
?>
