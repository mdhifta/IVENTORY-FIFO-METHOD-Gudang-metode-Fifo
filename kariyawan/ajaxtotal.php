<?php
session_start();
include '../database/config.php';

if($_POST['id']){
  $id=$_POST['id'];
  if($id==0){
    echo "Tidak ada harga";
  }else{
    $id_barang_msk = $_SESSION['id_barang_msk'];

    $query = $mysqli->query("SELECT harga FROM tb_barang_msk WHERE id_barang_msk='$id_barang_msk'");
    $harga = $query->fetch_object();
    $data_harga = $harga->harga+1500;
    echo '<label class="form-control-label" for="input-first-name">Total Harga : Rp. '.number_format($data_harga*$id).';-</label>';
  }
  $_SESSION['$id_product'] = 0;
}
?>