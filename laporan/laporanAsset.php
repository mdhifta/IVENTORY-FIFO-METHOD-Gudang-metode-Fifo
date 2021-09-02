<?php include '../database/config.php'; ?>
<title>Laporan Pembelian</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>LAPORAN BARANG ASSET <br> PADA TANGGAL <?= $_POST['awal'] ?> - <?= $_POST['akhir']  ?></h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="5%"><strong>No</strong></td>
      <td width="5%"><strong>Nama Barang</strong></td>
      <td width="20%"><strong>Sisa Barang</strong></td>
      <td width="20%"><strong>Harga Beli</strong></td>
      <td width="20%"><strong>Harga Jual</strong></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $tgl_awal = $_POST['awal'];
    $tgl_akhir = $_POST['akhir'];
    $no = 0;
    $dataPembelian = $mysqli->query("SELECT tbm.*, tbp.tanggal_beli, tbb.nama_brg, tbb.satuan, tbs.nama_supplier FROM tb_barang_msk as tbm JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbm.id_barang_msk JOIN tb_barang as tbb ON tbb.id_barang=tbm.id_barang JOIN tb_supplier as tbs ON tbs.id_supplier=tbp.id_supplier WHERE tbp.tanggal_beli BETWEEN '$tgl_awal' AND '$tgl_akhir' AND tbm.jumlah_masuk!=0 ORDER BY tbm.id_barang_msk");
    while ($barang = $dataPembelian->fetch_object()) {
      ?>
      <tr>
        <th scope="row"><?= $no+=1;  ?></th>
        <td><?= $barang->nama_brg;  ?></td>
        <td><?= $barang->jumlah_masuk; ?>/<?= $barang->satuan; ?></td>
        <td>Rp.<?= number_format($barang->harga); ?>/<?= $barang->satuan; ?></td>
        <td>Rp.<?= number_format($barang->harga+1500); ?>/<?= $barang->satuan; ?></td>
      </tr>
    <?php } ?>
  </table>
</tbody>
<?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>
