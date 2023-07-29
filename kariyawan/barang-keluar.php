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
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Tanggal Transaksi</th>
                                        <th scope="col">Total Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                $data = $mysqli->query("SELECT tbb.nama_brg, tbb.satuan, tbk.* FROM tb_barang as tbb JOIN tb_barang_klr as tbk ON tbk.id_barang=tbb.id_barang JOIN tb_penjualan as tbp ON tbp.id_barang_klr=tbk.id_barang_klr ORDER BY tbk.id_barang_klr DESC");

                while ($barang = $data->fetch_object()) {
                  ?>
                                    <tr>
                                        <th scope="row"><?= $barang->nama_brg;  ?></th>
                                        <td><?= $barang->jumlah;  ?>/<?= $barang->satuan; ?></td>
                                        <td><?= date("d M Y", strtotime($barang->tanggal_keluar));  ?></td>
                                        <td>Rp. <?= number_format($barang->harga);  ?>;-</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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