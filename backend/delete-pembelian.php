<?php
include('../database/config.php');
$id = $_GET['id'];

if ($mysqli->query("DELETE FROM tb_pembelian WHERE id_barang_msk='$id'")) {
  #get data barang
  $query = $mysqli->query("SELECT id_barang, jumlah_masuk FROM tb_barang_msk WHERE id_barang_msk='$id'");
  $data = $query->fetch_object();
  #eksekusi data
  if ($mysqli->query("UPDATE tb_barang SET jumlah=jumlah-$data->jumlah_masuk WHERE id_barang=$data->id_barang")) {
    #hapus data
    if ($mysqli->query("DELETE FROM tb_barang_msk WHERE id_barang_msk='$id'")) {
      header("Location:../admin/master-pembelian.php");
    } else {
      echo "error hapus barang masuk";
    }
  } else {
    echo "gagal update tb barang";
  }
} else {
  echo "error hapus pembelian";
}
?>
