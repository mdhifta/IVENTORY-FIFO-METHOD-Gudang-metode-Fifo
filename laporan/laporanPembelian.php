<?php include '../database/config.php'; ?>
<title>Laporan Pembelian</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>LAPORAN BARANG PEMBELIAN <br> PADA TANGGAL <?= $_POST['awal'] ?> - <?= $_POST['akhir']  ?></h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Telah Keluar</th>
      <th scope="col">Supplier</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Tanggal</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $tgl_awal = $_POST['awal'];
    $tgl_akhir = $_POST['akhir'];

    $dataPembelian = $mysqli->query("SELECT tbm.*, tbp.tanggal_beli, tbb.nama_brg, tbb.satuan, tbs.nama_supplier FROM tb_barang_msk as tbm JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbm.id_barang_msk JOIN tb_barang as tbb ON tbb.id_barang=tbm.id_barang JOIN tb_supplier as tbs ON tbs.id_supplier=tbp.id_supplier WHERE tbp.tanggal_beli BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tbm.id_barang_msk");
    while ($barang = $dataPembelian->fetch_object()) {
      ?>
      <tr>
        <th scope="row"><?= $barang->nama_brg;  ?></th>
        <td><?= $barang->jumlah_masuk;  ?></td>
        <td><?= $barang->history;  ?></td>
        <td><?= $barang->nama_supplier;  ?></td>
        <td>Rp.<?= number_format($barang->harga); ?>/<?= $barang->satuan; ?></td>
        <td><?= date("d M Y", strtotime($barang->tanggal_masuk));  ?></td>
      </tr>
    <?php } ?>
  </table>
</tbody>
<?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>
