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
                                    <form class="" action="../report/report-selling.php" target="_blank"
                                        method="post">
                                        <input type="date" name="start" style="border:none;">
                                        - sampai -
                                        <input type="date" name="end" style="border:none;">
                                        <button class="btn btn-sm btn-neutral">Print Report</button>
                                    </form>
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
                                        <th scope="col">Transaction Date</th>
                                        <th scope="col">Total Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $mysqli->query("SELECT tbi.item_name, tbi.unit_type, tbio.* 
                                    FROM tb_item as tbi
                                    JOIN tb_item_out as tbio ON tbio.item_id=tbi.id 
                                    JOIN tb_selling as tbs ON tbs.item_out_id=tbio.id 
                                    ORDER BY tbio.id DESC");

                                    while ($data = $query->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $data->item_name;  ?></th>
                                            <td><?= $data->total;  ?>/<?= $data->unit_type; ?></td>
                                            <td><?= date("d M Y", strtotime($data->date_out));  ?></td>
                                            <td>Rp. <?= number_format($data->price);  ?>;-</td>
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