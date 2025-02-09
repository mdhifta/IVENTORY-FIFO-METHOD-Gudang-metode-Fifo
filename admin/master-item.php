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
                        <div class="col-lg-6 col-5 text-right">
                            <a href="add-item.php" class="btn btn-sm btn-neutral">Add Item</a>
                            <a href="../report/report-item.php" target="_blank" class="btn btn-sm btn-primary">Print
                                Report</a>
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
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table id="file" class="table striped">
                                <thead>
                                    <tr>
                                        <td width="5%"><strong>Item Name</strong></td>
                                        <td width="20%"><strong>Total</strong></td>
                                        <td width="20%"><strong>Price Selling</strong></td>
                                        <td width="20%"><strong>Price Purchase</strong></td>
                                        <td width="15%"><strong>Type</strong></td>
                                        <td width="10%"><strong>Action</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $mysqli->query("SELECT * FROM tb_item");
                                    while ($item = $query->fetch_object()) { ?>
                                        <tr>
                                            <td><?= $item->item_name;  ?></td>
                                            <td><?= $item->quantity;  ?></td>
                                            <td>Rp. <?= number_format($item->selling_price); ?>;-</td>
                                            <td>Rp. <?= number_format($item->purchase_price); ?>;-</td>
                                            <td><?= $item->unit_type;  ?></td>
                                            <td>
                                                <a href="add-item.php?id=<?= $item->id; ?>"
                                                    class="btn btn-sm btn-info">Edit</a>
                                            </td>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
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