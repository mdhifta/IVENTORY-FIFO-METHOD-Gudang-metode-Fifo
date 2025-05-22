<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Store Asset</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Store Asset</li>
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
                                    <h3 class="mb-0">Store Asset</h3>
                                </div>
                                <div class="col-lg-10 col-5 text-right">
                                    <form class="" action="../report/report-asset.php" target="_blank" method="post">
                                        <input type="date" name="start" style="border:none;">
                                        - until -
                                        <input type="date" name="end" style="border:none;">
                                        <button class="btn btn-sm btn-neutral">Print Report</button>
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
                                        <td width="5%"><strong>Item Name</strong></td>
                                        <td width="20%"><strong>Stock</strong></td>
                                        <td width="20%"><strong>Purchase Price</strong></td>
                                        <td width="20%"><strong>Selling Price</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalSelling = 0;
                                    $totalPurchase = 0;
                                    $query = $mysqli->query("SELECT tbii.*, tbp.purchase_date, tbi.item_name, tbi.unit_type, tbs.name as supplier_name 
                                        FROM tb_item_in as tbii 
                                        JOIN tb_purchase as tbp ON tbp.item_in_id=tbii.id 
                                        JOIN tb_item as tbi ON tbi.id=tbii.item_id 
                                        JOIN tb_supplier as tbs ON tbs.id=tbp.supplier_id 
                                        WHERE tbii.total_in!=0");
                                    $no = 0;
                                    while ($data = $query->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $no += 1;  ?></th>
                                            <td><?= $data->item_name;  ?></td>
                                            <td><?= $data->total_in; ?>/<?= $data->unit_type; ?></td>
                                            <td><?= number_format($data->purchase_price); ?>/<?= $data->unit_type; ?></td>
                                            <td><?= number_format($data->selling_price + 1500); ?>/<?= $data->unit_type; ?></td>
                                        </tr>
                                        <?php
                                        $totalPurchase = $totalPurchase + ($data->purchase_price * $data->total_in);
                                        $totalSelling = $totalSelling + ($data->selling_price + 1500) * $data->total_in;
                                        ?>
                                    <?php } ?>
                                </tbody>
                                <tbody>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total (Price x Stock): Rp. <?= number_format($totalPurchase); ?>;-</b></td>
                                    <td><b>Total (Price x Stock): Rp. <?= number_format($totalSelling); ?>;-</b></td>
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