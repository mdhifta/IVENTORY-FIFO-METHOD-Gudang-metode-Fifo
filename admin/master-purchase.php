<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Master Purchase</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Master Purchase</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="select-supplier.php" class="btn btn-sm btn-neutral">Purchase Item</a>
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
                                    <h3 class="mb-0">Purchase Master</h3>
                                </div>
                                <div class="col-lg-10 col-5 text-right">
                                    <form class="" action="../report/report-purchase.php" target="_blank"
                                        method="post">
                                        <input type="date" required name="start" style="border:none;">
                                        - until -
                                        <input type="date" required name="end" style="border:none;">
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
                                        <td width="5%"><strong>Item</strong></td>
                                        <td width="20%"><strong>Quantity</strong></td>
                                        <td width="20%"><strong>Out</strong></td>
                                        <td width="20%"><strong>Supplier</strong></td>
                                        <td width="20%"><strong>Price Purchase</strong></td>
                                        <td width="15%"><strong>Date</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $mysqli->query("SELECT ti_in.*, tbp.purchase_date, tbi.item_name, tbi.unit_type, tbs.name as supplier_name 
                                    FROM tb_item_in as ti_in 
                                    JOIN tb_purchase as tbp ON tbp.item_in_id=ti_in.id 
                                    JOIN tb_item as tbi ON tbi.id=ti_in.item_id 
                                    JOIN tb_supplier as tbs ON tbs.id=tbp.supplier_id 
                                    WHERE ti_in.total_in!=0 ORDER BY ti_in.id");

                                    while ($item = $data->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $item->item_name;  ?></th>
                                            <td><?= $item->total_in;  ?></td>
                                            <td><?= $item->history;  ?></td>
                                            <td><?= $item->supplier_name;  ?></td>
                                            <td><?= number_format($item->price); ?>/<?= $item->unit_type; ?></td>
                                            <td><?= date("d M Y", strtotime($item->date_in));  ?></td>
                                        </tr>
                                    <?php } ?>
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