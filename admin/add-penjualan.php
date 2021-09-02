<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Penjualan</title>
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
                  <li class="breadcrumb-item active" aria-current="page">Penjualan Barang</li>
                </ol>
              </nav>
            </div>
            <!-- <div class="col-lg-6 col-5 text-right">
            <a href="master-pembelian.php" class="btn btn-sm btn-neutral">Kembali</a>
          </div> -->
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
                <h3 class="mb-0">Transaksi Penjualan</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="../backend/add-penjualan.php" method="post">
              <h6 class="heading-small text-muted mb-4">Lengkapi Data Dibawah</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">Nama Barang</label>

                      <select class="form-control" name="id_barang" id="id_barang">
                        <?php
                        $query = $mysqli->query("SELECT * FROM tb_barang WHERE jumlah!=0");
                        while ($barang = $query->fetch_object()) {
                          ?>
                          <option value="<?= $barang->id_barang; ?>"><?= $barang->nama_brg;  ?></option>
                        <?php } ?>
                      </select>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Jumlah Barang</label>
                      <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah Barang" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group" id="tampilTotal">

                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button class="btn btn-primary my-4">TAMBAH</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include("asset/footer.php"); ?>
  </div>
</div>

<?php include("asset/js.php"); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
  $("#id_barang").change(function()
  {
    var id_product=$(this).val();
    var post_id = 'id='+ id_product;

    $.ajax
    ({
      type: "POST",
      url: "ajax.php",
      data: post_id,
      cache: false,
    });

  });
});
</script>

<script type="text/javascript">
$(document).ready(function()
{
  $("#jumlah").change(function()
  {
    var id_product=$(this).val();
    var post_id = 'id='+ id_product;

    $.ajax
    ({
      type: "POST",
      url: "ajaxtotal.php",
      data: post_id,
      cache: false,
      success: function(cities)
      {
        $("#tampilTotal").html(cities);
      }
    });

  });
});
</script>

</body>

</html>
