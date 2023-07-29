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
                                    <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Master Admin</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="add-admin.php" class="btn btn-sm btn-neutral">Tambah Admin</a>
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
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nama Admin</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telephone</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                $data = $mysqli->query("SELECT * FROM tb_admin");

                while ($akses = $data->fetch_object()) {
                  ?>
                                    <tr>
                                        <th scope="row"><?= $akses->nama_admin; ?></th>
                                        <td><?= $akses->username; ?></td>
                                        <td><?= $akses->email; ?></td>
                                        <td><?= $akses->no_handphone; ?></td>
                                        <td>
                                            <?php if ($admin->level==1) {
                        if ($admin->id_admin==$akses->id_admin) {
                          echo '<a href="add-admin.php?id='.$akses->id_admin.'" class="btn btn-sm btn-info">Ubah</a>';
                        } else {
                          echo '
                          <a href="add-admin.php?id='.$akses->id_admin.'" class="btn btn-sm btn-info">Ubah</a>
                          <a href="../backend/delete-admin.php?id='.$akses->id_admin.'" class="btn btn-sm btn-danger">Hapus</a>
                          ';
                        }
                      } else {
                        echo "Akses anda dibatasi";
                      }?>
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