<?php @$id = $_GET['id']; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Pembelian</title>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

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
                                    <?php if (isset($id)): ?>
                                    <li class="breadcrumb-item active" aria-current="page">Ubah Pembelian Barang</li>
                                    <?php else: ?>
                                    <li class="breadcrumb-item active" aria-current="page">Pembelian Barang</li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="master-pembelian.php" class="btn btn-sm btn-neutral">Kembali</a>
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
                                    <?php if (isset($id)): ?>
                                    <h3 class="mb-0">Ubah Transaksi Pembelian</h3>
                                    <?php else: ?>
                                    <h3 class="mb-0">Transaksi Pembelian</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($id)): ?>
                        <?php
              $query = $mysqli->query("SELECT tbm.*, tbb.id_barang, tbb.nama_brg, tbs.*, tbp.jumlah_beli FROM tb_barang_msk as tbm JOIN tb_pembelian as tbp ON tbp.id_barang_msk=tbm.id_barang_msk JOIN tb_barang as tbb ON tbb.id_barang=tbm.id_barang JOIN tb_supplier as tbs ON tbs.id_supplier=tbp.id_supplier WHERE tbm.id_barang_msk='$id'");
              $data = $query->fetch_object();
              ?>

                        <div class="card-body">
                            <form action="../backend/change-pembelian.php" method="post">
                                <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Barang</label>
                                                <input type="text" class="form-control" id="input-username" readonly
                                                    value="<?= $data->nama_brg; ?>">
                                                <input type="hidden" name="id_barang" value="<?= $data->id_barang; ?>">
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <input type="hidden" name="jlama" value="<?= $data->jumlah_beli; ?>">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Supplier</label>

                                                <select class="form-control" id="select-supplier" name="id_supplier">
                                                    <option value="<?= $data->id_supplier; ?>">
                                                        <?= $data->nama_supplier;  ?></option>
                                                    <?php
                            $query = $mysqli->query("SELECT * FROM tb_supplier");
                            while ($supplier = $query->fetch_object()) {
                              ?>
                                                    <?php if ($supplier->id_supplier!=$data->id_supplier): ?>
                                                    <option value="<?= $supplier->id_supplier; ?>">
                                                        <?= $supplier->nama_supplier;  ?></option>
                                                    <?php endif; ?>
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
                                                <input type="number" id="input-first-name" name="jumlah"
                                                    class="form-control" value="<?= $data->jumlah_beli; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Harga
                                                    Barang</label>
                                                <input type="number" id="input-first-name" name="harga"
                                                    class="form-control" value="<?= $data->harga; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary my-4">UBAH</button>
                                </div>
                            </form>
                        </div>
                        <?php else: ?>
                        <div class="card-body">
                            <form action="backend/keranjang.php" method="post">
                                <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Barang</label>

                                                <select id="select-barang" class="form-control" name="id_barang">
                                                    <?php
                            $query = $mysqli->query("SELECT * FROM tb_barang");
                            while ($barang = $query->fetch_object()) {
                              ?>
                                                    <option value="<?= $barang->id_barang; ?>">
                                                        <?= $barang->nama_brg;  ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Supplier</label>

                                                <select class="form-control" name="id_supplier" readonly>
                                                    <?php
                            $query = $mysqli->query("SELECT * FROM tb_supplier WHERE id_supplier=".$_SESSION['id_supplier']);
                            while ($barang = $query->fetch_object()) {
                              ?>
                                                    <option value="<?= $barang->id_supplier; ?>">
                                                        <?= $barang->nama_supplier;  ?></option>
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
                                                <input type="number" id="input-first-name" name="jumlah"
                                                    class="form-control" placeholder="Jumlah Barang" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Harga
                                                    Barang</label>
                                                <input type="number" id="input-first-name" name="harga"
                                                    class="form-control" placeholder="Harga Barang/ (Pcs/Kg)" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary my-4">TAMBAH</button>
                                </div>
                            </form>
                        </div>
                        <?php endif; ?>

                        <?php if ($_SESSION['id_barang']!=null): ?>
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
                                <?php $no=1; ?>
                                <?php $query = $mysqli->query("SELECT * FROM tb_supplier WHERE id_supplier=".$_SESSION['id_supplier']); ?>
                                <?php $supplier = $query->fetch_assoc(); ?>
                                <?php if (isset($_SESSION['id_barang'])): ?>
                                <?php foreach($_SESSION['id_barang'] as $num_array => $id_barang): ?>

                                <!-- Menampilkan produk yang sedang duperulangkan berdasarkan id_produk -->
                                <?php
                    $ambil = $mysqli->query("SELECT nama_brg FROM tb_barang WHERE id_barang='$id_barang'");
                    $tmp = $ambil->fetch_assoc();

                    ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $tmp['nama_brg']; ?></td>
                                    <td><?= $supplier['nama_supplier']; ?></td>
                                    <td style="font-size:20px;"><?= $_SESSION['jumlah'][$num_array]; ?>&nbsp;
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger"
                                            href="backend/hapuskeranjang.php?id=<?= $num_array; ?>"><i
                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                        <a class="btn btn-primary" href="backend/keranjang.php?id=<?= $num_array; ?>"><i
                                                class="fa fa-plus" aria-hidden="true"></i></a>
                                    </td>
                                    <td>Rp. <?= number_format($_SESSION['harga'][$num_array]); ?>,-</td>
                                    <td>Rp.
                                        <?= number_format($_SESSION['harga'][$num_array]*$_SESSION['jumlah'][$num_array]); ?>,-
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="card-footer">
                            <center>
                                <a href="backend/addpembelian.php" class="btn btn-success">SIMPAN</a>
                            </center>
                        </div>
                        <?php endif; ?>
                        <!-- jarak -->

                    </div>
                </div>
            </div>
            <?php include("asset/footer.php"); ?>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {

        // Initialize select2
        $("#select-barang").select2();

    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        // Initialize select2
        $("#select-supplier").select2();

    });
    </script>
</body>

</html>