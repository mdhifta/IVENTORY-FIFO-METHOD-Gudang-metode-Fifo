<?php @$id = $_GET['id']; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Manage User</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                                    <?php else: ?>
                                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="master-user.php" class="btn btn-sm btn-neutral">Back</a>
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
                                        <h3 class="mb-0">Edit User</h3>
                                    <?php else: ?>
                                        <h3 class="mb-0">Add User</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($id)): ?>
                            <?php
                            $query = $mysqli->query("SELECT * FROM tb_employees WHERE id='$id'");
                            $data = $query->fetch_object();
                            ?>
                            <div class="card-body">
                                <form action="../backend/change-user.php" method="post">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Employee Name</label>
                                                    <input type="text" id="input-username" name="name"
                                                        class="form-control" value="<?= $data->name; ?>">
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $data->id; ?>">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Phone</label>
                                                    <input type="number" id="input-email" name="phone" class="form-control"
                                                        value="<?= $data->phone; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Email</label>
                                                    <input type="email" id="input-first-name" name="email"
                                                        class="form-control" value="<?= $data->email; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="input-first-name">Username</label>
                                                    <input type="text" id="input-first-name" name="username"
                                                        class="form-control" value="<?= $data->username; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name">Password</label>
                                                    <input type="password" id="input-last-name" name="password"
                                                        class="form-control" value="<?= $data->password; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary my-4">EDIT</button>
                                    </div>
                                </form>
                            </div>
                            <!-- endif -->
                        <?php else: ?>
                            <div class="card-body">
                                <form action="../backend/add-user.php" method="post">
                                    <?php if (isset($_GET['id'])): ?>
                                        <h6 class="heading-small text-muted mb-4">Username Already Exist!</h6>
                                    <?php endif; ?>

                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Employee Name</label>
                                                    <input type="text" id="input-username" name="name"
                                                        class="form-control" placeholder="Employee Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Phone</label>
                                                    <input type="number" id="input-email" name="phone" class="form-control"
                                                        placeholder="Phone Number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Email</label>
                                                    <input type="email" id="input-first-name" name="email"
                                                        class="form-control" placeholder="Email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="input-first-name">Username</label>
                                                    <input type="text" id="input-first-name" name="username"
                                                        class="form-control" placeholder="username" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name">Password</label>
                                                    <input type="password" id="input-last-name" name="password"
                                                        class="form-control" placeholder="password" required>
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