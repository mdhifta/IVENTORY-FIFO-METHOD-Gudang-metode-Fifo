<?php include '../database/config.php'; ?>
<title>Laporan Barang Penjualan</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>LAPORAN BARANG PENJUALAN <br> PADA TANGGAL <?= $_POST['awal'] ?> - <?= $_POST['akhir']  ?></h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="5%"><strong>Nama Barang</strong></td>
      <td width="20%"><strong>Jumlah</strong></td>
      <td width="20%"><strong>Tanggal Transaksi</strong></td>
      <td width="20%"><strong>Total Bayar</strong></td>
      <td width="20%"><strong>Laba</strong></td>
      <td width="20%"><strong>Kariyawan</strong></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $tgl_awal = $_POST['awal'];
    $tgl_akhir = $_POST['akhir'];

    $dataPenjualan = $mysqli->query("SELECT tbb.nama_brg, tbb.satuan, tbk.*, tbp.tanggal_jual, tbkr.nama_kariyawan FROM tb_barang as tbb JOIN tb_barang_klr as tbk ON tbk.id_barang=tbb.id_barang JOIN tb_penjualan as tbp ON tbp.id_barang_klr=tbk.id_barang_klr JOIN tb_kariyawan as tbkr ON tbkr.id_kariyawan=tbp.id_kariyawan WHERE tbp.tanggal_jual BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tbk.id_barang_klr DESC");
    while ($barang = $dataPenjualan->fetch_object()) {
      ?>
      <tr>
        <th scope="row"><?= $barang->nama_brg;  ?></th>
        <td><?= $barang->jumlah;  ?>/<?= $barang->satuan; ?></td>
        <td><?= date("d M Y", strtotime($barang->tanggal_keluar));  ?></td>
        <td>Rp. <?= number_format($barang->harga);  ?>;-</td>
        <td>Rp. <?= number_format($barang->jumlah*1500);  ?>;-</td>
        <td><?= $barang->nama_kariyawan;  ?></td>
      </tr>
    <?php } ?>
  </table>
</tbody>
<?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>
