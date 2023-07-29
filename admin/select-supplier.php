<?php  @$id = $_GET['id']; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pilih Supplier</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Pilih Supplier</li>
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
                                    <h3 class="mb-0">Pilih Supplier</h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="backend/add-supplier.php" method="post">
                                <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
                                <div class="pl-lg-4">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Supplier</label>

                                                <select class="form-control" id="select-supplier" name="id_supplier">
                                                    <?php
                          $query = $mysqli->query("SELECT * FROM tb_supplier");
                          while ($barang = $query->fetch_object()) {
                            ?>
                                                    <option value="<?= $barang->id_supplier; ?>">
                                                        <?= $barang->nama_supplier;  ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary my-4">LANJUT</button>
                                </div>
                            </form>
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
        $("#select-supplier").select2();

    });
    </script>
</body>

</html>