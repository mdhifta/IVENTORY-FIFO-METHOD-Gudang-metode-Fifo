<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Asset Nilai Toko</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Asset Nilai Toko</li>
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
                                    <h3 class="mb-0">Pembelian Master</h3>
                                </div>
                                <div class="col-lg-10 col-5 text-right">
                                    <form class="" action="../laporan/laporanAsset.php" target="_blank" method="post">
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
                                        <td width="5%"><strong>No</strong></td>
                                        <td width="5%"><strong>Nama Barang</strong></td>
                                        <td width="20%"><strong>Sisa Barang</strong></td>
                                        <td width="20%"><strong>Harga Beli</strong></td>
                                        <td width="20%"><strong>Harga Jual</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                  $nilaiJual = 0;
                  $nilaiBeli = 0;
                  $data = $mysqli->query("SELECT tbm.*, tbp.tanggal_beli, tbb.nama_brg, tbb.satuan, tbs.nama_supplier FROM tb_barang_msk as tbm JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbm.id_barang_msk JOIN tb_barang as tbb ON tbb.id_barang=tbm.id_barang JOIN tb_supplier as tbs ON tbs.id_supplier=tbp.id_supplier WHERE tbm.jumlah_masuk!=0");
                  $no = 0;
                  while ($barang = $data->fetch_object()) {
                    ?>
                                    <tr>
                                        <th scope="row"><?= $no+=1;  ?></th>
                                        <td><?= $barang->nama_brg;  ?></td>
                                        <td><?= $barang->jumlah_masuk; ?>/<?= $barang->satuan; ?></td>
                                        <td>Rp.<?= number_format($barang->harga); ?>/<?= $barang->satuan; ?></td>
                                        <td>Rp.<?= number_format($barang->harga+1500); ?>/<?= $barang->satuan; ?></td>
                                    </tr>
                                    <?php
                    $nilaiBeli = $nilaiBeli+($barang->harga*$barang->jumlah_masuk);
                    $nilaiJual = $nilaiJual+($barang->harga+1500)*$barang->jumlah_masuk;
                     ?>
                                    <?php } ?>
                                </tbody>
                                <tbody>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total (Harga x Jumlah): Rp. <?= number_format($nilaiBeli); ?>;-</b></td>
                                    <td><b>Total (Harga x Jumlah): Rp. <?= number_format($nilaiJual); ?>;-</b></td>
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