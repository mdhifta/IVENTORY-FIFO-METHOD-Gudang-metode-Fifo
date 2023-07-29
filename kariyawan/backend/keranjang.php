<?php
session_start();
include("../../database/config.php");

// menampilkan id_produk dari url
if (isset($_POST['id_barang'])) {
  $id_barang = $_POST['id_barang'];
  $banyak_barang = $_POST['jumlah'];
  $no = 0;
  foreach ($_SESSION['id_barang'] as $row => $id_tmp) {
    if ($id_tmp==$id_barang) {
      $id_barang = $id_tmp;
      $row = $no;
      $no+=1;
      $tmpJumlah = $_SESSION['jumlah'][$row]+$banyak_barang;
      break;
    } else {
      $id_barang = $_POST['id_barang'];
      $banyak_barang = $_POST['jumlah'];
      $row = null;
    }
  }
} else {
  $id_barang = $_GET['id'];
  @$row = $_GET['row'];
}

$ambil = $mysqli->query("SELECT * FROM tb_barang as tb JOIN tb_barang_msk as tbm ON tbm.id_barang=tb.id_barang WHERE tbm.id_barang='$id_barang' AND jumlah_masuk!=0");
$data = $ambil->fetch_object();

if(@$_SESSION['jumlah'][$row]>=$data->jumlah){
  // Dialihkan ke halaman keranjang
  echo "<script>alert('Produk melebihi batas stok!');</script>";
  echo "<script>location='../add-penjualan.php';</script>";
} else {

  // jika sudah ada produk di keranjang, maka produk itu jumlahnya +1
  if(isset($_SESSION['jumlah'][@$row])){
    if ($_SESSION['jumlah'][@$row]>=$data->jumlah) {
      echo "<script>alert('Produk melebihi batas stok!');</script>";
      echo "<script>location='../add-penjualan.php';</script>";
    } elseif($tmpJumlah<=$data->jumlah) {
      $_SESSION['jumlah'][$row]+= $banyak_barang;
      echo "<script>location='../add-penjualan.php';</script>";
    } else {
      $_SESSION['jumlah'][$row]+= 1;
      echo "<script>location='../add-penjualan.php';</script>";
    }
  }
  // selain itu (belum ada di keranjang), maka produk itu dianggap dibeli 1
  else{
    if ($data->jumlah<$banyak_barang) {
      echo "<script>alert('Produk melebihi batas stok!');</script>";
      echo "<script>location='../add-penjualan.php';</script>";
    } else {
      array_push($_SESSION['id_barang'], $id_barang);
      array_push($_SESSION['jumlah'], $banyak_barang);
      array_push($_SESSION['harga'], $data->harga+1500);
      header('location:../add-penjualan.php');
    }
  }
}