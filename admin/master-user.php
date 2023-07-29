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
                                    <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Master User</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="add-user.php" class="btn btn-sm btn-neutral">Tambah User</a>
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
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nama Kariyawan</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Kontak</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                $data = $mysqli->query("SELECT * FROM tb_kariyawan");

                while ($kariyawan = $data->fetch_object()) {
                  ?>
                                    <tr>
                                        <th scope="row"><?= $kariyawan->nama_kariyawan;  ?></th>
                                        <td><?= $kariyawan->username; ?></td>
                                        <td><?= $kariyawan->kontak; ?></td>
                                        <td><?= $kariyawan->email; ?></td>
                                        <td>
                                            <a href="../backend/delete-kariyawan.php?id=<?= $kariyawan->id_kariyawan; ?>"
                                                class="btn btn-sm btn-danger">Hapus</a>
                                            <a href="add-user.php?id=<?= $kariyawan->id_kariyawan; ?>"
                                                class="btn btn-sm btn-info">Ubah</a>
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