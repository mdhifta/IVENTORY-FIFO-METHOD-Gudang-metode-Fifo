<?php @$id = $_GET['id']; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Item</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
                                    <?php else: ?>
                                        <li class="breadcrumb-item active" aria-current="page">Add Item</li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="master-item.php" class="btn btn-sm btn-neutral">Back</a>
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
                                        <h3 class="mb-0">Edit Item</h3>
                                    <?php else: ?>
                                        <h3 class="mb-0">Add Item</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($id)): ?>
                            <?php
                            $query = $mysqli->query("SELECT * FROM tb_item WHERE id='$id'");
                            $item = $query->fetch_object();
                            ?>
                            <div class="card-body">
                                <form action="../backend/change-items.php" method="post">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Item Name</label>
                                                    <input type="text" id="input-username" name="item_name"
                                                        class="form-control" value="<?= $item->item_name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name">Unit Type</label>
                                                    <select class="form-control" name="unit_type">
                                                        <?php
                                                        if ($item->unit_type == "Kg") {
                                                            echo '
                                  <option value="Kg">Kg</option>
                                  <option value="Pcs">Pcs</option>';
                                                        } else {
                                                            echo '
                                  <option value="Pcs">Pcs</option>
                                  <option value="Kg">Kg</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Selling Price</label>
                                                    <input type="number" readonly id="input-first-name" name="selling_price"
                                                        class="form-control" value="<?= $item->selling_price; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Quantity</label>
                                                    <input type="number" readonly id="input-email" name="quantity"
                                                        class="form-control" value="<?= $item->quantity; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $item->id; ?>">
                                    <div class="text-center">
                                        <button class="btn btn-primary my-4">EDIT</button>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="card-body">
                                <form action="../backend/add-items.php" method="post">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Item Name</label>
                                                    <input type="text" id="input-username" name="item_name"
                                                        class="form-control" placeholder="Item Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name">Unit Type</label>
                                                    <select class="form-control" name="unit_type">
                                                        <option value="Kg">Kg</option>
                                                        <option value="Pcs">Pcs</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="hidden" readonly id="input-first-name" name="selling_price"
                                                        class="form-control" value="0">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="hidden" readonly id="input-email" name="quantity"
                                                        class="form-control" value="0">
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
                    </div>
                </div>
            </div>
            <?php include("asset/footer.php"); ?>
        </div>
    </div>

    <?php include("asset/js.php"); ?>
</body>

</html>