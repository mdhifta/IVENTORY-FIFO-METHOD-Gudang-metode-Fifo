<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Master Admin</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Master Admin</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="add-admin.php" class="btn btn-sm btn-neutral">Add Admin</a>
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
                                    <h3 class="mb-0">Master Admin</h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush table striped" id="file">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $admin = $mysqli->query("SELECT * FROM tb_admin WHERE id=" . $_SESSION['admin_id'])->fetch_object();

                                    $query = $mysqli->query("SELECT * FROM tb_admin");
                                    while ($data = $query->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $data->name; ?></th>
                                            <td><?= $data->username; ?></td>
                                            <td><?= $data->email; ?></td>
                                            <td><?= $data->phone; ?></td>
                                            <td>
                                                <?php if ($admin->level == '1') {
                                                    if ($_SESSION['admin_id'] == $data->id) {
                                                        echo '<a href="add-admin.php?id=' . $data->id . '" class="btn btn-sm btn-info">Edit</a>';
                                                    } else {
                                                        echo '
                          <a href="add-admin.php?id=' . $data->id . '" class="btn btn-sm btn-info">Edit</a>
                          <a href="../backend/delete-admin.php?id=' . $data->id . '" class="btn btn-sm btn-danger">Delete</a>
                          ';
                                                    }
                                                } else {
                                                    echo "<span class='badge bg-danger text-white'>Limited Access</span>";
                                                } ?>
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