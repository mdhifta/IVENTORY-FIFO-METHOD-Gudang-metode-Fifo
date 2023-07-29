<?php
session_start();
$id_kariyawan = $_SESSION['id_kariyawan'];

include("../../database/config.php");

#data post
$data_id = array();
$i = 0;

foreach ($_SESSION['id_barang'] as $row => $id_barang) {
  $jumlah = $_SESSION['jumlah'][$row];
  $harga = $_SESSION['harga'][$row];
  #proses
  #get data id barang masuk
  $query = $mysqli->query("SELECT * FROM tb_barang_msk as tbs JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbs.id_barang_msk WHERE tbs.id_barang='$id_barang' AND tbs.jumlah_masuk!=0 ORDER BY tbs.id_barang_msk ASC");
  while ($data = $query->fetch_object()) {
    $data_id[$i+=1] = $data->id_barang_msk;
  }

  #proses fifo
  for ($j=1; $j<=$i; $j++) {
    #jumlah barang masuk yang tersedia
    $barang_masuk = $mysqli->query("SELECT tbm.jumlah_masuk as jumlah_masuk, tbm.harga as harga FROM tb_barang_msk as tbm JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbm.id_barang_msk WHERE tbm.id_barang_msk=$data_id[$j]");
    $data = $barang_masuk->fetch_object();
    $harga_baru = $harga;
    #jika data jumlah masuk lebih sedikit dibanding jumlah keluar
    if ($jumlah>=$data->jumlah_masuk) {
      #update data barang masuk
      if ($mysqli->query("UPDATE tb_barang_msk SET jumlah_masuk=0, history=history+$data->jumlah_masuk WHERE id_barang_msk=$data_id[$j]")) {
        if ($mysqli->query("UPDATE tb_barang SET jumlah=jumlah-$data->jumlah_masuk, harga_beli='$data->harga', harga_jual='$harga_baru' WHERE id_barang='$id_barang'")) {
          #mendapatkan nilai dasar baru
          $jumlah_tmp = $jumlah-$data->jumlah_masuk;

          #Hitung jumlah
          $jumlah_hitung = $jumlah-$jumlah_tmp;

          $total = ($harga)*$jumlah_hitung;

          if ($mysqli->query("INSERT INTO tb_barang_klr(id_barang, jumlah, harga, tanggal_keluar) VALUES('$id_barang', '$data->jumlah_masuk', '$total', NOW())")) {

            #mengambil id yang baru dimasukan
            $id_barang_klr = $mysqli->insert_id;

            if ($mysqli->query("INSERT INTO tb_penjualan(id_barang_klr, id_kariyawan, tanggal_jual) VALUES('$id_barang_klr', '$id_kariyawan', NOW())")) {
              #menghitung sisa barang
              $jumlah = $jumlah_tmp;

              if ($jumlah==0) {
                $cek = 1;
                break;
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
      if ($mysqli->query("UPDATE tb_barang SET jumlah=jumlah-$jumlah, harga_beli='$data->harga', harga_jual='$harga_baru' WHERE id_barang='$id_barang'")) {
        #update tb barang msk
        if ($mysqli->query("UPDATE tb_barang_msk SET jumlah_masuk=jumlah_masuk-$jumlah, history=history+$jumlah WHERE id_barang_msk=$data_id[$j]")) {

          #mendapatkan nilai harga
          $total = ($harga)*$jumlah;
          if ($mysqli->query("INSERT INTO tb_barang_klr(id_barang, jumlah, harga, tanggal_keluar) VALUES('$id_barang', '$jumlah', '$total', NOW())")) {
            #mengambil id yang baru dimasukan
            $id_barang_klr = $mysqli->insert_id;
            if ($mysqli->query("INSERT INTO tb_penjualan(id_barang_klr, id_kariyawan, tanggal_jual) VALUES('$id_barang_klr', '$id_kariyawan', NOW())")) {
              $cek = 1;
              break;
            } else {
              echo "gagal memasukan data ke tb_penjualan 2";
            }
          } else {
            echo "gagal memasukan data ke tb_barang_klr 2";
          }
        } else {
          echo "gagal update tb_barang_msk 2";
        }
      } else {
        echo "gagal update tb_barang 2";
      }
    }
  }
  #end Proses
}
?>

<?php include("css.php"); ?>
<title>Struk</title>
<img src="../../vendor/images/favicon.png" alt="" style="width:100px;margin-left:5%;">

<h1 style="float:right;margin-right:30%;">STRUK PEMBAYARAN & PEMBELIAN TOKO IDA<br> Jl. Raya Tegal Miring<br>
    <p>Pembelian pada tanggal/Jam <?= date('d-M-Y / h:i A') ?></p>
</h1>

<!-- jarak -->
<table id="example2" class="table table-bordered table-hover" style="margin-top:2%;border:none;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Banyak Barang</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php
    $no=1;
    $tot = 0;
    ?>
        <?php if (isset($_SESSION['id_barang'])): ?>
        <?php foreach($_SESSION['id_barang'] as $row => $id_barang): ?>

        <!-- Menampilkan produk yang sedang duperulangkan berdasarkan id_produk -->
        <?php
        $ambil = $mysqli->query("SELECT nama_brg, harga_jual FROM tb_barang WHERE id_barang='$id_barang'");
        $tmp = $ambil->fetch_object();

        $subharga = $_SESSION['harga'][$row] * $_SESSION['jumlah'][$row];
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $tmp->nama_brg; ?></td>
            <td><?= $_SESSION['jumlah'][$row]; ?>
            </td>
            <td>Rp. <?= number_format($_SESSION['harga'][$row]); ?>,-</td>
            <td>Rp. <?= number_format($subharga); ?>,-</td>
        </tr>
        <?php $tot = $tot+$subharga ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td><b>TOTAL: </b></td>
        <td><b>Rp. <?= number_format($tot); ?></b></td>
    </tbody>
</table>
<script type="text/javascript">
window.print();
</script>

<?php
if ($cek==1) {
  $_SESSION['jumlah'] = array();
  $_SESSION['id_barang'] = array();
  $_SESSION['harga'] = array();
} else {
  echo "error move";
}
?>