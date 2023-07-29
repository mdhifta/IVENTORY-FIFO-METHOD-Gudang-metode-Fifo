<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Penjualan</title>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item active" aria-current="page">Penjualan Barang</li>
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
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Transaksi Penjualan</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="backend/keranjang.php" method="post">
                                <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Barang</label>

                                                <select class="form-control" name="id_barang" id="id_barang">
                                                    <?php
                        $query = $mysqli->query("SELECT * FROM tb_barang WHERE jumlah!=0");
                        while ($barang = $query->fetch_object()) {
                          ?>
                                                    <option value="<?= $barang->id_barang; ?>">
                                                        <?= $barang->nama_brg;  ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Jumlah
                                                    Barang</label>
                                                <input type="number" id="jumlah" name="jumlah" class="form-control"
                                                    placeholder="Jumlah Barang" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary my-4">TAMBAH</button>
                                </div>
                            </form>

                            <?php if ($_SESSION['id_barang']!=null): ?>
                            <!-- jarak -->
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Banyak Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    <?php if (isset($_SESSION['id_barang'])): ?>
                                    <?php foreach($_SESSION['id_barang'] as $row => $id_barang): ?>

                                    <!-- Menampilkan produk yang sedang duperulangkan berdasarkan id_produk -->
                                    <?php
                $ambil = $mysqli->query("SELECT nama_brg, harga_jual FROM tb_barang WHERE id_barang='$id_barang'");
                $tmp = $ambil->fetch_object();

                $subharga = $_SESSION['harga'][$row] * $_SESSION['jumlah'][$row];
                ?>
                                    <tr>
                                        <td style="font-size:20px;"><?= $no++; ?></td>
                                        <td style="font-size:20px;"><?= $tmp->nama_brg; ?></td>
                                        <td style="font-size:20px;"><?= $_SESSION['jumlah'][$row]; ?>&nbsp; &nbsp;&nbsp;
                                            <a class="btn btn-danger"
                                                href="backend/hapuskeranjang.php?id=<?= $row; ?>">-</a>
                                            <a class="btn btn-primary"
                                                href="backend/keranjang.php?id=<?= $id_barang; ?>&row=<?= $row; ?>">+</a>
                                        </td>
                                        <td style="font-size:20px;">Rp.
                                            <?= number_format($_SESSION['harga'][$row]); ?>,-</td>
                                        <td style="font-size:20px;">Rp. <?= number_format($subharga); ?>,-</td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <div class="card-footer">
                                <center>
                                    <a href="backend/add-penjualan.php" class="btn btn-success">SIMPAN TRANSAKSI</a>
                                </center>
                            </div>
                            <?php endif; ?>
                            <!-- jarak -->
                        </div>
                    </div>
                </div>
            </div>
            <?php include("asset/footer.php"); ?>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {

        // Initialize select2
        $("#id_barang").select2();

    });
    </script>

    <!-- <?php include("asset/js.php"); ?> -->

</body>

</html>