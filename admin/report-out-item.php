<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Report Selling</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Report Selling</li>
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
                                    <h3 class="mb-0">Report Selling</h3>
                                </div>
                                <div class="col-lg-10 col-5 text-right">
                                    <form class="" action="../report/report-selling.php" target="_blank"
                                        method="post">
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
                                        <td width="5%"><strong>Item Name</strong></td>
                                        <td width="20%"><strong>Quantity</strong></td>
                                        <td width="20%"><strong>Supplier</strong></td>
                                        <td width="20%"><strong>Transaction Date</strong></td>
                                        <td width="20%"><strong>Total Payment</strong></td>
                                        <td width="20%"><strong>Profit</strong></td>
                                        <td width="20%"><strong>Employee</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $mysqli->query("SELECT tbb.item_name, tbb.unit_type, tbio.*, tbss.selling_date, 
                                            tbe.name as employee_name, tbs.name as supplier_name
                                            FROM tb_item as tbb
                                            JOIN tb_item_out as tbio ON tbio.item_id=tbb.id
                                            JOIN tb_selling as tbss ON tbss.item_out_id=tbio.id
                                            JOIN tb_employees as tbe ON tbe.id=tbss.employee_id
                                            JOIN tb_item_in as tbii ON tbii.item_id=tbb.id
                                            JOIN tb_purchase as tbp ON tbp.item_in_id=tbii.id
                                            JOIN tb_supplier as tbs ON tbs.id=tbp.supplier_id
                                            ORDER BY tbio.id DESC");

                                    while ($data = $query->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $data->item_name;  ?></th>
                                            <td><?= $data->total;  ?>/<?= $data->unit_type; ?></td>
                                            <td><?= $data->supplier_name; ?></td>
                                            <td><?= date("d M Y", strtotime($data->date_out));  ?></td>
                                            <td><?= number_format($data->price);  ?>;-</td>
                                            <td><?= number_format($data->total * 1500);  ?>;-</td>
                                            <td><?= $data->employee_name;  ?></td>
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