<?php  @$id = $_GET['id']; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Admin</title>
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
                                    <?php if (isset($id)): ?>
                                    <li class="breadcrumb-item active" aria-current="page">Ubah Admin</li>
                                    <?php else: ?>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="master-admin.php" class="btn btn-sm btn-neutral">Kembali</a>
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
                                    <h3 class="mb-0">Ubah Admin</h3>
                                    <?php else: ?>
                                    <h3 class="mb-0">Tambah Admin</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($id)): ?>
                        <?php
              $query = $mysqli->query("SELECT * FROM tb_admin WHERE id_admin='$id'");
              $data = $query->fetch_object();
              ?>
                        <div class="card-body">
                            <form action="../backend/change-admin.php" method="post">
                                <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Admin</label>
                                                <input type="text" id="input-username" name="nadmin"
                                                    class="form-control" value="<?= $data->nama_admin; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Email</label>
                                                <input type="email" id="input-username" name="email"
                                                    class="form-control" value="<?= $data->email; ?>">
                                            </div>
                                            <?php
                        if ($admin->level==1) {
                          echo '
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">Hak Akses</label>
                              <select class="form-control" name="hak">';
                              if ($data->level==1) {
                                echo '
                                <option value="1">Keseluruhan</option>
                                <option value="0">Dibatasi</option>
                                ';
                              } else {
                                echo '
                                <option value="0">Dibatasi</option>
                                <option value="1">Keseluruhan</option>
                                ';
                              }
                          echo '
                              </select>
                          </div>';
                        } else {
                          echo '<input type="hidden" id="input-username" name="hak" class="form-control" value="0">';
                        } ?>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $data->id_admin; ?>">
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
                                                <label class="form-control-label"
                                                    for="input-first-name">Telephone/Kontak</label>
                                                <input type="number" id="input-first-name" name="telp"
                                                    class="form-control" value="<?= $data->no_handphone; ?>">
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
                                    <button class="btn btn-primary my-4">UBAH</button>
                                </div>
                            </form>
                        </div>
                        <!-- endif -->
                        <?php else: ?>
                        <div class="card-body">
                            <form action="../backend/add-admin.php" method="post">
                                <?php if (isset($_GET['id'])): ?>
                                <h6 class="heading-small text-muted mb-4">Username Sudah Ada!</h6>
                                <?php else: ?>
                                <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
                                <?php endif; ?>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nama
                                                    Admin</label>
                                                <input type="text" id="input-username" name="nadmin"
                                                    class="form-control" placeholder="Nama Admin" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Email</label>
                                                <input type="email" id="input-username" name="email"
                                                    class="form-control" placeholder="Email" required>
                                            </div>
                                            <?php
                        if ($admin->level==1) {
                          echo '
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">Hak Akses</label>
                            <select class="form-control" name="hak">
                              <option value="1">Keseluruhan</option>
                              <option value="0">Dibatasi</option>
                            </select>
                          </div>';
                        } else {
                          echo '<input type="hidden" id="input-username" name="hak" class="form-control" value="0">';
                        } ?>
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
                                                <label class="form-control-label"
                                                    for="input-first-name">Telephone/Kontak</label>
                                                <input type="number" id="input-first-name" name="telp"
                                                    class="form-control" placeholder="Telephone/Kontak">
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
                                    <button class="btn btn-primary my-4">TAMBAH</button>
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