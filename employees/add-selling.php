<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Selling</title>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item active" aria-current="page">Selling</li>
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
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Transaction</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="backend/cart.php" method="post">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Item</label>

                                                <select class="form-control" name="item_id" id="item_id">
                                                    <?php
                                                    $query = $mysqli->query("SELECT * FROM tb_item WHERE quantity!=0");
                                                    while ($data = $query->fetch_object()) {
                                                    ?>
                                                        <option value="<?= $data->id; ?>">
                                                            <?= $data->item_name;  ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Quantity</label>
                                                <input type="number" id="quantity" name="quantity" class="form-control"
                                                    placeholder="Quantity" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary my-4">SUBMIT</button>
                                </div>
                            </form>

                            <?php if ($_SESSION['item_id'] != null): ?>
                                <!-- jarak -->
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php if (isset($_SESSION['item_id'])): ?>
                                            <?php foreach ($_SESSION['item_id'] as $row => $item_id): ?>

                                                <!-- Menampilkan produk yang sedang duperulangkan berdasarkan id_produk -->
                                                <?php
                                                $tmp = $mysqli->query("SELECT item_name, selling_price FROM tb_item WHERE id='$item_id'")->fetch_object();
                                                $sub_price = $_SESSION['price'][$row] * $_SESSION['quantity'][$row];
                                                ?>
                                                <tr>
                                                    <td style="font-size:20px;"><?= $no++; ?></td>
                                                    <td style="font-size:20px;"><?= $tmp->item_name; ?></td>
                                                    <td style="font-size:20px;"><?= $_SESSION['quantity'][$row]; ?>&nbsp; &nbsp;&nbsp;
                                                        <a class="btn btn-danger"
                                                            href="backend/delete-cart.php?id=<?= $row; ?>">-</a>
                                                        <a class="btn btn-primary"
                                                            href="backend/cart.php?id=<?= $item_id; ?>&row=<?= $row; ?>">+</a>
                                                    </td>
                                                    <td style="font-size:20px;">Rp.
                                                        <?= number_format($_SESSION['price'][$row]); ?>,-</td>
                                                    <td style="font-size:20px;">Rp. <?= number_format($sub_price); ?>,-</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="card-footer">
                                    <center>
                                        <a href="backend/add-selling.php" class="btn btn-success">SAVE TRANSACTION</a>
                                    </center>
                                </div>
                            <?php endif; ?>
                            <!-- jarak -->
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
            $("#item_id").select2();

        });
    </script>

    <!-- <?php include("asset/js.php"); ?> -->

</body>

</html>