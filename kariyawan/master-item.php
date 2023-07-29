<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Master Item</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Master Barang</li>
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
                                    <h3 class="mb-0">Item Master</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="../laporan/laporanBarang.php" target="_blank"
                                        class="btn btn-sm btn-primary">cetak Laporan</a>
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