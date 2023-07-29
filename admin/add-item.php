<?php @$id = $_GET['id']; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Item</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Ubah Barang</li>
                                    <?php else: ?>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="master-item.php" class="btn btn-sm btn-neutral">Kembali</a>
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
                                    <h3 class="mb-0">Ubah Item</h3>
                                    <?php else: ?>
                                    <h3 class="mb-0">Tambah Item</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($id)): ?>
                        <?php
              $query = $mysqli->query("SELECT * FROM tb_barang WHERE id_barang='$id'");
              $barang = $query->fetch_object();
              ?>
                        <div class="card-body">
                            <form action="../backend/change-items.php" method="post">
                                <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Barang</label>
                                                <input type="text" id="input-username" name="nbarang"
                                                    class="form-control" value="<?= $barang->nama_brg; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Satuan</label>
                                                <select class="form-control" name="satuan">
                                                    <?php
                              if($barang->satuan=="Kg"){
                                echo '
                                  <option value="Kg">Kg</option>
                                  <option value="Pcs">Pcs</option>';
                              } else {
                                echo '
                                  <option value="Pcs">Pcs</option>
                                  <option value="Kg">Kg</option>';
                              }
                             ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Harga
                                                    Jual</label>
                                                <input type="number" readonly id="input-first-name" name="hjual"
                                                    class="form-control" value="<?= $barang->harga_jual; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Jumlah</label>
                                                <input type="number" readonly id="input-email" name="jumlah"
                                                    class="form-control" value="<?= $barang->jumlah; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?= $barang->id_barang; ?>">
                                <div class="text-center">
                                    <button class="btn btn-primary my-4">UBAH</button>
                                </div>
                            </form>
                        </div>
                        <?php else: ?>
                        <div class="card-body">
                            <form action="../backend/add-items.php" method="post">
                                <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Barang</label>
                                                <input type="text" id="input-username" name="nbarang"
                                                    class="form-control" placeholder="Nama Barang" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Satuan</label>
                                                <select class="form-control" name="satuan">
                                                    <option value="Kg">Kg</option>
                                                    <option value="Pcs">Pcs</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="hidden" readonly id="input-first-name" name="hjual"
                                                    class="form-control" value="0">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="hidden" readonly id="input-email" name="jumlah"
                                                    class="form-control" value="0">
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
                    </div>
                </div>
            </div>
            <?php include("asset/footer.php"); ?>
        </div>
    </div>

    <?php include("asset/js.php"); ?>
</body>

</html>