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
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Master Item</li>
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
                                    <a href="../report/report-item.php" target="_blank"
                                        class="btn btn-sm btn-primary">Print Report</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush striped" id="file">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Purchase Price</th>
                                        <th scope="col">Selling Price</th>
                                        <th scope="col">Unit Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $mysqli->query("SELECT * FROM tb_item");

                                    while ($data = $query->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $data->item_name;  ?></th>
                                            <td><?= $data->quantity;  ?></td>
                                            <td><?= number_format($data->selling_price); ?>;-</td>
                                            <td><?= number_format($data->purchase_price); ?>;-</td>
                                            <td><?= $data->unit_type;  ?></td>
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