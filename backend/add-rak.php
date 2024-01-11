<?php
include('../database/config.php');

$nama_rak = $_POST['nama_rak'];
$deskripsi_rak = $_POST['deskripsi_rak'];

if($mysqli->query("INSERT INTO tb_rak_barang(nama_rak, deskripsi_rak) VALUES('$nama_rak', '$deskripsi_rak')")) {
  header('Location:../admin/rak-barang.php');
} else {
  echo "query error";
}
?>
