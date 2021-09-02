<?php include '../database/config.php'; ?>
<title>Laporan Barang</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<center>
  <h4>LAPORAN BARANG</h4>
  <br>
</center>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Satuan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $data = $mysqli->query("SELECT * FROM tb_barang");
      while ($barang = $data->fetch_object()) {
        ?>
        <tr>
          <th scope="row"><?= $barang->nama_brg;  ?></th>
          <td><?= $barang->jumlah;  ?></td>
          <td>Rp. <?= number_format($barang->harga_jual); ?>;-</td>
          <td>Rp. <?= number_format($barang->harga_beli); ?>;-</td>
          <td><?= $barang->satuan;  ?></td>
        </tr>
      <?php } ?>
    </table>
  </tbody>
  <?php include '../js.php'; ?>

<script type="text/javascript">
  window.print();
</script>
