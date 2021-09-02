<?php include '../database/config.php'; ?>
<title>Laporan Barang Penjualan</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>LAPORAN BARANG KELUAR <br> PADA TANGGAL <?= $_POST['awal'] ?> - <?= $_POST['akhir']  ?></h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead class="thead-light">
    <tr>
      <td width="5%"><strong>Nama Barang</strong></td>
      <td width="20%"><strong>Jumlah</strong></td>
      <td width="20%"><strong>Telah Keluar</strong></td>
      <td width="20%"><strong>Supplier</strong></td>
      <td width="20%"><strong>Harga Beli</strong></td>
      <td width="20%"><strong>Tanggal</strong></td>
      <td width="20%"><strong>Status</strong></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $tgl_awal = $_POST['awal'];
    $tgl_akhir = $_POST['akhir'];

    $data = $mysqli->query("SELECT tbm.*, tbp.tanggal_beli, tbb.nama_brg, tbb.satuan, tbs.nama_supplier FROM tb_barang_msk as tbm JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbm.id_barang_msk JOIN tb_barang as tbb ON tbb.id_barang=tbm.id_barang JOIN tb_supplier as tbs ON tbs.id_supplier=tbp.id_supplier WHERE tbp.tanggal_beli BETWEEN '$tgl_awal' AND '$tgl_akhir' AND tbm.jumlah_masuk=0 ORDER BY tbm.id_barang_msk DESC");

    while ($barang = $data->fetch_object()) {
      ?>
      <tr>
        <th scope="row"><?= $barang->nama_brg;  ?></th>
        <td><?= $barang->jumlah_masuk;  ?></td>
        <td><?= $barang->history;  ?></td>
        <td><?= $barang->nama_supplier;  ?></td>
        <td>Rp.<?= number_format($barang->harga); ?>/<?= $barang->satuan; ?></td>
        <td><?= date("d M Y", strtotime($barang->tanggal_masuk));  ?></td>
        <td>
          <span>SEMUA BARANG SUDAH KELUAR</span>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</tbody>
<?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>
