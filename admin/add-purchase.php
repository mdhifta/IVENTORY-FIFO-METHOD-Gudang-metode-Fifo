<?php @$id = $_GET['id']; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Purchase</title>
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
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <?php if (isset($id)): ?>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Purchase</li>
                                    <?php else: ?>
                                        <li class="breadcrumb-item active" aria-current="page">Add Purchase</li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="master-purchase.php" class="btn btn-sm btn-neutral">Back</a>
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
                                        <h3 class="mb-0">Edit Purchase</h3>
                                    <?php else: ?>
                                        <h3 class="mb-0">Add Purchase</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($id)): ?>
                            <?php
                            $query = $mysqli->query("SELECT tbii.*, tbi.id as item_id, tbi.item_name, tbs.name as supplier_name, tbs.id as supplier_id, tbp.purchase_total 
                            FROM tb_item_in as tbii 
                            JOIN tb_purchase as tbp ON tbp.item_in_id=tbii.id 
                            JOIN tb_item as tbi ON tbi.id=tbm.item_id 
                            JOIN tb_supplier as tbs ON tbs.id=tbp.id_supplier 
                            WHERE tbii.id='$id'");
                            $data = $query->fetch_object();
                            ?>

                            <div class="card-body">
                                <form action="../backend/change-pembelian.php" method="post">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Item</label>
                                                    <input type="text" class="form-control" id="input-username" readonly
                                                        value="<?= $data->nama_brg; ?>">
                                                    <input type="hidden" name="item_id" value="<?= $data->item_id; ?>">
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $id; ?>">
                                            <input type="hidden" name="last_stock" value="<?= $data->purchase_total; ?>">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Supplier</label>

                                                    <select class="form-control" id="select-supplier" name="supplier_id">
                                                        <option value="<?= $data->supplier_id; ?>">
                                                            <?= $data->supplier_name;  ?></option>
                                                        <?php
                                                        $query = $mysqli->query("SELECT * FROM tb_supplier");
                                                        while ($supplier = $query->fetch_object()) {
                                                        ?>
                                                            <?php if ($supplier->id != $data->supplier_id): ?>
                                                                <option value="<?= $supplier->id; ?>">
                                                                    <?= $supplier->name;  ?></option>
                                                            <?php endif; ?>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Quantity</label>
                                                    <input type="number" id="input-first-name" name="quantity"
                                                        class="form-control" value="<?= $data->purchase_total; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Price</label>
                                                    <input type="number" id="input-first-name" name="price"
                                                        class="form-control" value="<?= $data->purchase_price; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary my-4">EDIT</button>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="card-body">
                                <form action="backend/add-cart.php" method="post">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Item</label>

                                                    <select id="select-item" class="form-control" name="item_id" id="select-item">
                                                        <?php
                                                        $query = $mysqli->query("SELECT * FROM tb_item");
                                                        while ($item = $query->fetch_object()) {
                                                        ?>
                                                            <option value="<?= $item->id; ?>">
                                                                <?= $item->item_name;  ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Nama
                                                        Supplier</label>

                                                    <select class="form-control" name="supplier_id" readonly>
                                                        <?php
                                                        $query = $mysqli->query("SELECT * FROM tb_supplier WHERE id=" . $_SESSION['supplier_id']);
                                                        while ($supplier = $query->fetch_object()) {
                                                        ?>
                                                            <option value="<?= $supplier->id; ?>">
                                                                <?= $supplier->name;  ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Quantity</label>
                                                    <input type="number" id="input-first-name" name="quantity"
                                                        class="form-control" placeholder="Total Item" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Price</label>
                                                    <input type="number" id="input-first-name" name="price"
                                                        class="form-control" placeholder="Price/ (Pcs/Kg)" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary my-4">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>

                        <?php if ($_SESSION['item_id'] != null): ?>
                            <!-- jarak -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Supplier</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php $query = $mysqli->query("SELECT * FROM tb_supplier WHERE id=" . $_SESSION['supplier_id']); ?>
                                        <?php $supplier = $query->fetch_assoc(); ?>
                                        <?php if (isset($_SESSION['item_id'])): ?>
                                            <?php foreach ($_SESSION['item_id'] as $num_array => $item_id): ?>
                                                <?php
                                                $get_query = $mysqli->query("SELECT item_name FROM tb_item WHERE id='$item_id'");
                                                $item_temp = $get_query->fetch_assoc();
                                                ?>

                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $item_temp['item_name']; ?></td>
                                                    <td><?= $supplier['name']; ?></td>
                                                    <td style="font-size:20px;"><?= $_SESSION['quantity'][$num_array]; ?>&nbsp;
                                                        &nbsp;&nbsp;
                                                        <a class="btn btn-danger"
                                                            href="backend/delete-cart.php?id=<?= $num_array; ?>"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <a class="btn btn-primary" href="backend/add-cart.php?id=<?= $num_array; ?>"><i
                                                                class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td><?= number_format($_SESSION['price'][$num_array]); ?>,-</td>
                                                    <td>
                                                        <?= number_format($_SESSION['price'][$num_array] * $_SESSION['quantity'][$num_array]); ?>,-
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="card-footer">
                                    <center>
                                        <a href="backend/add-purchase.php" class="btn btn-success">SAVE</a>
                                    </center>
                                </div>
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
            $("#select-item").select2();

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