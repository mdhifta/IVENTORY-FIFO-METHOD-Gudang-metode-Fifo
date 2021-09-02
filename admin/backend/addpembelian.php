<?php
session_start();
include("../../database/config.php");
$id_supplier = $_SESSION['id_supplier'];
?>

<?php include("css.php"); ?>
<title>Struk</title>
<img src="../../vendor/images/favicon.png" alt="" style="width:100px;margin-left:5%;">
<?php
$query = $mysqli->query("SELECT * FROM tb_supplier WHERE id_supplier='$id_supplier'");
$supplier = $query->fetch_object();
?>
<h1 style="float:right;margin-right:30%;">STRUK PEMBAYARAN & PEMBELIAN TOKO IDA<br> Jl. Raya Tegal Miring<br><p>Pembelian pada tanggal/Jam <?= date('d-M-Y / h:i A') ?> <br>Supplier - <?=  $supplier->nama_supplier; ?></p></h1>

<!-- jarak -->
<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Nama Supplier</th>
      <th>Jumlah Barang</th>
      <th>Harga Barang</th>
      <th>Total Harga</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; $tot = 0; ?>
    <?php $query = $mysqli->query("SELECT * FROM tb_supplier WHERE id_supplier=".$_SESSION['id_supplier']); ?>
    <?php $supplier = $query->fetch_assoc(); ?>
    <?php if (isset($_SESSION['id_barang'])): ?>
      <?php foreach($_SESSION['id_barang'] as $num_array => $id_barang): ?>

        <!-- Menampilkan produk yang sedang duperulangkan berdasarkan id_produk -->
        <?php
        $ambil = $mysqli->query("SELECT nama_brg FROM tb_barang WHERE id_barang='$id_barang'");
        $tmp = $ambil->fetch_assoc();
        $subharga = $_SESSION['harga'][$num_array]*$_SESSION['jumlah'][$num_array];
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $tmp['nama_brg']; ?></td>
          <td><?= $supplier['nama_supplier']; ?></td>
          <td style="font-size:20px;"><?= $_SESSION['jumlah'][$num_array]; ?>
          </td>
          <td>Rp. <?= number_format($_SESSION['harga'][$num_array]); ?>,-</td>
          <td>Rp. <?= number_format($subharga); ?>,-</td>
        </tr>
        <?php $tot = $tot+$subharga; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
  <tbody>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><b>TOTAL : </b></td>
    <td><b>Rp. <?= number_format($tot); ?>;-</b></td>
  </tbody>
</table>
<script type="text/javascript">
  window.print();
</script>

<?php
foreach ($_SESSION['id_barang'] as $num_array => $id_barang){
  #get data jumlah and harga
  $jumlah = $_SESSION['jumlah'][$num_array];
  $harga = $_SESSION['harga'][$num_array];

  if($mysqli->query("INSERT INTO tb_barang_msk(id_barang, jumlah_masuk, history, harga, tanggal_masuk) VALUES('$id_barang', $jumlah, '0', $harga, NOW())")) {
    $id_barang_msk = $mysqli->insert_id;
    if ($mysqli->query("INSERT INTO tb_pembelian(id_barang_msk, id_supplier, jumlah_beli, tanggal_beli) VALUES('$id_barang_msk', $id_supplier, $jumlah, NOW())")) {
      if ($mysqli->query("UPDATE tb_barang SET jumlah=jumlah+$jumlah WHERE id_barang=$id_barang")) {
        $cek = 1;
        unset($_SESSION['id_barang'][$num_array]);
        unset($_SESSION['jumlah'][$num_array]);
        unset($_SESSION['harga'][$num_array]);
      }
    } else {
      echo "gagal memasukan data ke tb_pembelian";
      $cek = 2;
    }
  } else {
    echo "query error";
    $cek = 0;
  }
}
 ?>
