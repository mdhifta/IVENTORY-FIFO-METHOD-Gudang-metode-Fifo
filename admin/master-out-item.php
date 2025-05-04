<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Master Selling</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Master Selling</li>
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
                                    <h3 class="mb-0">Selling Master</h3>
                                </div>
                                <div class="col-lg-10 col-5 text-right">
                                    <form class="" action="../report/report-item-out.php" target="_blank" method="post">
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
                                        <td width="20%"><strong>Purchase Price</strong></td>
                                        <td width="20%"><strong>Date</strong></td>
                                        <td width="20%"><strong>Status</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $mysqli->query("SELECT tbii.*, tbp.purchase_date, tbi.item_name, tbi.unit_type, tbs.name as supplier_name
                                        FROM tb_item_in as tbii 
                                        JOIN tb_purchase as tbp ON tbp.item_in_id=tbii.id 
                                        JOIN tb_item as tbi ON tbi.id=tbii.item_id 
                                        JOIN tb_supplier as tbs ON tbs.id=tbp.supplier_id 
                                        WHERE tbii.total_in=0 ORDER BY tbii.id");

                                    while ($data = $query->fetch_object()) {?>
                                        <tr>
                                            <th scope="row"><?= $data->item_name;  ?></th>
                                            <td><?= $data->total_in;  ?></td>
                                            <td><?= $data->history;  ?></td>
                                            <td><?= $data->supplier_name;  ?></td>
                                            <td>Rp.<?= number_format($data->price); ?>/<?= $data->unit_type; ?></td>
                                            <td><?= date("Y-m-d", strtotime($data->date_in));  ?></td>
                                            <td>
                                                <span class="badge bg-success text-white">ALL ITEM ALREADY OUT</span>
                                            </td>
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