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
                        <div class="col-lg-6 col-5 text-right">
                            <a href="add-item.php" class="btn btn-sm btn-neutral">Tambah Barang</a>
                            <a href="../laporan/laporanBarang.php" target="_blank" class="btn btn-sm btn-primary">cetak
                                Laporan</a>
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
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table id="file" class="table striped">
                                <thead>
                                    <tr>
                                        <td width="5%"><strong>Nama Barang</strong></td>
                                        <td width="20%"><strong>Jumlah</strong></td>
                                        <td width="20%"><strong>Harga Jual</strong></td>
                                        <td width="20%"><strong>Harga Beli</strong></td>
                                        <td width="15%"><strong>Satuan</strong></td>
                                        <td width="10%"><strong>Aksi</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                  $query = $mysqli->query("SELECT * FROM tb_barang");
                  while ($barang = $query->fetch_object()) { ?>
                                    <tr>
                                        <td><?= $barang->nama_brg;  ?></td>
                                        <td><?= $barang->jumlah;  ?></td>
                                        <td>Rp. <?= number_format($barang->harga_jual); ?>;-</td>
                                        <td>Rp. <?= number_format($barang->harga_beli); ?>;-</td>
                                        <td><?= $barang->satuan;  ?></td>
                                        <td>
                                            <a href="add-item.php?id=<?= $barang->id_barang; ?>"
                                                class="btn btn-sm btn-info">Ubah</a>
                                        </td>
                                        </td>
                                    </tr>
                                    <?php
                } ?>
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