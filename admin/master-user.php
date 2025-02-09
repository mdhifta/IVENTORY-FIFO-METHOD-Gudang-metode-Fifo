<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Master User</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">Master User</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="add-user.php" class="btn btn-sm btn-neutral">Add User</a>
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
                                    <h3 class="mb-0">Master User</h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush table striped" id="file">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Employee Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $mysqli->query("SELECT * FROM tb_employees");
                                    while ($employees = $data->fetch_object()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $employees->name;  ?></th>
                                            <td><?= $employees->username; ?></td>
                                            <td><?= $employees->phone; ?></td>
                                            <td><?= $employees->email; ?></td>
                                            <td>
                                                <a href="../backend/delete-employees.php?id=<?= $employees->id; ?>"
                                                    class="btn btn-sm btn-danger">Delete</a>
                                                <a href="add-user.php?id=<?= $employees->id; ?>"
                                                    class="btn btn-sm btn-info">Edit</a>
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