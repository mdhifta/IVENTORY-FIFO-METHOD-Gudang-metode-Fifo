<?php
include('../database/config.php');

$id_barang = $_POST['id_barang'];
$id_supplier = $_POST['id_supplier'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];


if($mysqli->query("INSERT INTO tb_barang_msk(id_barang, jumlah_masuk, history, harga, tanggal_masuk) VALUES('$id_barang', '$jumlah', '0', '$harga', NOW())")) {
  $id_barang_msk = $mysqli->insert_id;
  if ($mysqli->query("INSERT INTO tb_pembelian(id_barang_msk, id_supplier, jumlah_beli, tanggal_beli) VALUES('$id_barang_msk', '$id_supplier', '$jumlah', NOW())")) {
    if ($mysqli->query("UPDATE tb_barang SET jumlah=jumlah+$jumlah WHERE id_barang=$id_barang")) {
      header('Location:../admin/master-pembelian.php');
    }
  } else {
    echo "gagal memasukan data ke tb_pembelian";
  }
} else {
  echo "query error";
}
?>
