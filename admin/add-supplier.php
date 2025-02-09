<?php @$id = $_GET['id']; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Supplier</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Change Supplier</li>
                                    <?php else: ?>
                                        <li class="breadcrumb-item active" aria-current="page">Add Supplier</li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="master-supplier.php" class="btn btn-sm btn-neutral">Back</a>
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
                                        <h3 class="mb-0">Change Supplier</h3>
                                    <?php else: ?>
                                        <h3 class="mb-0">Add Supplier</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($id)): ?>
                            <?php
                            $query = $mysqli->query("SELECT * FROM tb_supplier WHERE id='$id'");
                            $supplier = $query->fetch_object();
                            ?>
                            <div class="card-body">
                                <form action="../backend/change-supplier.php" method="post">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Supplier Name</label>
                                                    <input type="text" id="input-username" name="nsupplier"
                                                        class="form-control" value="<?= $supplier->name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Address</label>
                                                    <input type="text" id="input-email" name="address" class="form-control"
                                                        value="<?= $supplier->address; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Phone</label>
                                                    <input type="number" id="input-first-name" name="phone"
                                                        class="form-control" value="<?= $supplier->phone; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $supplier->id; ?>">
                                    <div class="text-center">
                                        <button class="btn btn-primary my-4">EDIT</button>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="card-body">
                                <form action="../backend/add-supplier.php" method="post">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Supplier Name</label>
                                                    <input type="text" id="input-username" name="nsupplier"
                                                        class="form-control" placeholder="Supplier Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Address</label>
                                                    <input type="text" id="input-email" name="address" class="form-control"
                                                        placeholder="Supplier Address" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Phone</label>
                                                    <input type="number" id="input-first-name" name="phone"
                                                        class="form-control" placeholder="Supplier Phone Number"
                                                        required>
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