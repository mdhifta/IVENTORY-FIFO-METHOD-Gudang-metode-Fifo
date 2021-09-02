<?php
include('../database/config.php');

#data
$id_barang_msk = $_POST['id'];
$id_barang = $_POST['id_barang'];
$id_supplier = $_POST['id_supplier'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$jumlah_lama = $_POST['jlama'];

#seleksi data Barang
$query = $mysqli->query("SELECT * FROM tb_barang WHERE id_barang='$id_barang'");
$data = $query->fetch_object();

$jumlah_baru = $data->jumlah-$jumlah_lama;
#eksekusi
if($mysqli->query("UPDATE tb_barang_msk SET id_barang='$id_barang', jumlah_masuk='$jumlah', harga='$harga' WHERE id_barang_msk='$id_barang_msk'")) {
  if ($mysqli->query("UPDATE tb_pembelian SET id_supplier='$id_supplier', jumlah_beli='$jumlah' WHERE id_barang_msk='$id_barang_msk'")) {
    if ($mysqli->query("UPDATE tb_barang SET jumlah=$jumlah_baru+$jumlah WHERE id_barang='$id_barang'")) {
      header('Location:../admin/master-pembelian.php');
    } else {
      echo "error update barang";
    }
  } else {
    echo "gagal memasukan data ke tb_pembelian";
  }
} else {
  echo "query error";
}
?>
