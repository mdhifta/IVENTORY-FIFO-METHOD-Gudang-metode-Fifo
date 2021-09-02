<?php
include("../database/config.php");

#data post
$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];
$data_id = array();
$i = 0;

#get data id barang masuk
$query = $mysqli->query("SELECT * FROM tb_barang_msk as tbs JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbs.id_barang_msk WHERE tbs.id_barang='$id_barang' AND tbs.jumlah_masuk!=0 ORDER BY tbs.id_barang_msk ASC");
while ($data = $query->fetch_object()) {
  $data_id[$i+=1] = $data->id_barang_msk;
}

#proses fifo
for ($j=1; $j<=$i; $j++) {
  #jumlah barang masuk yang tersedia
  $barang_masuk = $mysqli->query("SELECT tbm.jumlah_masuk as jumlah_masuk, tbp.harga as harga FROM tb_barang_msk as tbm JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbm.id_barang_msk WHERE tbm.id_barang_msk=$data_id[$j]");
  $data = $barang_masuk->fetch_object();
  echo "disini atas dalam for";
  #jika data jumlah masuk lebih sedikit dibanding jumlah keluar
  if ($jumlah>=$data->jumlah_masuk) {
    echo "disini atas jumlah";
    #update data barang masuk
    if ($mysqli->query("UPDATE tb_barang_msk SET jumlah_masuk=0, jumlah_keluar=jumlah_keluar+$data->jumlah_masuk WHERE id_barang_msk=$data_id[$j]")) {
      if ($mysqli->query("UPDATE tb_barang SET jumlah=jumlah-$data->jumlah_masuk, harga_beli='$data->harga', harga_jual=$data->harga+1500 WHERE id_barang='$id_barang'")) {
        if ($mysqli->query("INSERT INTO tb_barang_klr(id_barang, jumlah, tanggal_keluar) VALUES('$id_barang', '$data->jumlah_masuk', NOW())")) {
          #mendapatkan nilai dasar baru
          $jumlah_tmp = $jumlah-$data->jumlah_masuk;

          #Hitung jumlah
          $jumlah_hitung = $jumlah-$jumlah_tmp;

          #mengambil id yang baru dimasukan
          $id_barang_klr = $mysqli->insert_id;
          $total = ($data->harga+1500)*$jumlah_hitung;
          echo "disini atas";
          if ($mysqli->query("INSERT INTO tb_penjualan(id_barang_klr, jumlah, harga) VALUES('$id_barang_klr', '$jumlah', '$total')")) {
            #menghitung sisa barang
            $jumlah = $jumlah_tmp;
            echo "disini";
            if ($jumlah==0) {
              header("Location:../admin/barang-keluar.php");
              break;
            } else {
              echo "disini 0";
            }
          } else {
            echo "gagal memasukan data ke tb_penjualan";
          }
        } else {
          echo "gagal memasukan data ke tb_barang_klr";
        }
      } else {
        echo "gagal update tb_barang";
      }
    } else {
      echo "gagal update tb_barang_msk";
    }
    #jika data jumlah masuk lebih banyak dibanding jumlah keluar
  } else {
    #udpate tb barang
    if ($mysqli->query("UPDATE tb_barang SET jumlah=jumlah-$jumlah, harga_beli='$data->harga', harga_jual=$data->harga+1500 WHERE id_barang='$id_barang'")) {
      #update tb barang msk
      if ($mysqli->query("UPDATE tb_barang_msk SET jumlah_masuk=jumlah_masuk-$jumlah, jumlah_keluar=jumlah_keluar+$jumlah WHERE id_barang_msk=$data_id[$j]")) {
        if ($mysqli->query("INSERT INTO tb_barang_klr(id_barang, jumlah, tanggal_keluar) VALUES('$id_barang', '$jumlah', NOW())")) {
          #mengambil id yang baru dimasukan
          $id_klr = $mysqli->insert_id;
          $total = ($data->harga+1500)*$jumlah;
          if ($mysqli->query("INSERT INTO tb_penjualan(id_barang_klr, jumlah, harga) VALUES('$id_klr', '$jumlah', '$total')")) {
            header("Location:../admin/barang-keluar.php");
            break;
          } else {
            echo "gagal memasukan data ke tb_penjualan";
          }
        } else {
          echo "gagal memasukan data ke tb_barang_klr";
        }
      } else {
        echo "gagal update tb_barang_msk";
      }
    } else {
      echo "gagal update tb_barang";
    }
  }
}

echo "disini bawah";

?>
