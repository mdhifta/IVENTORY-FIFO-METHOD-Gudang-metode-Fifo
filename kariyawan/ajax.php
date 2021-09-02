<?php
session_start();
include '../database/config.php';

if($_POST['id']){
  $id=$_POST['id'];
  if($id==0){
    echo "Tidak ada harga";
  }else{
    $query = $mysqli->query("SELECT id_barang_msk FROM tb_barang_msk WHERE id_barang='$id' AND jumlah_masuk!='0' ORDER BY id_barang_msk ASC");
    $data = $query->fetch_object();

    $_SESSION['id_barang_msk'] = $data->id_barang_msk;
  }
}
?>
