<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Master Penjualan</title>
    <?php include("asset/css.php"); ?>
</head>

<body>
    <!-- sidebar -->
    <?php include("asset/sidebar.php"); ?>
    <!-- sidebar end -->

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- navbar -->
        <?php include("asset/navbar.php"); ?>
        <!-- navbar end -->

        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Master Penjualan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Penjualan Master</h3>
                                </div>
                                <div class="col-lg-10 col-5 text-right">
                                    <form class="" action="../laporan/laporanPenjualan.php" target="_blank"
                                        method="post">
                                        <input type="date" name="awal" style="border:none;">
                                        - sampai -
                                        <input type="date" name="akhir" style="border:none;">
                                        <button class="btn btn-sm btn-neutral">Cetak Laporan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table id="file" class="table striped">
                                <thead>
                                    <tr>
                                        <td width="5%"><strong>Nama Barang</strong></td>
                                        <td width="20%"><strong>Jumlah</strong></td>
                                        <td width="20%"><strong>Supplier</strong></td>
                                        <td width="20%"><strong>Tanggal Transaksi</strong></td>
                                        <td width="20%"><strong>Total Bayar</strong></td>
                                        <td width="20%"><strong>Laba</strong></td>
                                        <td width="20%"><strong>Kariyawan</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                  $data = $mysqli->query("SELECT tbb.nama_brg, tbb.satuan, tbk.*, tbp.tanggal_jual, tbkr.nama_kariyawan, tbs.nama_supplier
FROM tb_barang as tbb
JOIN tb_barang_klr as tbk
ON tbk.id_barang=tbb.id_barang
JOIN tb_penjualan as tbp
ON tbp.id_barang_klr=tbk.id_barang_klr
JOIN tb_kariyawan as tbkr
ON tbkr.id_kariyawan=tbp.id_kariyawan
JOIN tb_barang_msk as tbm
ON tbm.id_barang=tbb.id_barang
JOIN tb_pembelian as tbpm
ON tbpm.id_barang_msk=tbm.id_barang_msk
JOIN tb_supplier as tbs
ON tbs.id_supplier=tbpm.id_supplier
ORDER BY tbk.id_barang_klr DESC");

                  while ($barang = $data->fetch_object()) {
                    ?>
                                    <tr>
                                        <th scope="row"><?= $barang->nama_brg;  ?></th>
                                        <td><?= $barang->jumlah;  ?>/<?= $barang->satuan; ?></td>
                                        <td><?= $barang->nama_supplier; ?></td>
                                        <td><?= date("d M Y", strtotime($barang->tanggal_keluar));  ?></td>
                                        <td>Rp. <?= number_format($barang->harga);  ?>;-</td>
                                        <td>Rp. <?= number_format($barang->jumlah*1500);  ?>;-</td>
                                        <td><?= $barang->nama_kariyawan;  ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                </div>
            </div>
            <?php include("asset/footer.php"); ?>
        </div>
    </div>

    <?php include("asset/js.php"); ?>
</body>

</html>