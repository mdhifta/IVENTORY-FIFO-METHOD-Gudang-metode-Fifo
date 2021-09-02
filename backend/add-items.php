<?php
include('../database/config.php');

$nama_brg = $_POST['nbarang'];
$jumlah = $_POST['jumlah'];
$harga_beli = $_POST['hbeli'];
$harga_jual = $_POST['hjual'];
$satuan = $_POST['satuan'];

if($mysqli->query("INSERT INTO tb_barang(nama_brg, jumlah, harga_beli, harga_jual, satuan) VALUES('$nama_brg', '$jumlah', '0', '0', '$satuan')")) {
  header('Location:../admin/master-item.php');
} else {
  echo "query error";
}
?>
