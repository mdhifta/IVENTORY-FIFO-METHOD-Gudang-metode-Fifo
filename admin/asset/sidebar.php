<?php
session_start();
include("../database/config.php");
$id_admin = $_SESSION['id_admin'];
$query = $mysqli->query("SELECT * FROM tb_admin WHERE id_admin='$id_admin'");

$admin = $query->fetch_object();

if ($_SESSION['id_admin'] == '') {
  header("Location:../index.php");
}
?>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="../vendor/images/blue.png" class="navbar-brand-img" alt="...">
      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="dashboard.php">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="master-item.php">
              <i class="ni ni-app text-green"></i>
              <span class="nav-link-text">Master Barang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="supplier.php">
              <i class="ni ni-circle-08 text-yellow"></i>
              <span class="nav-link-text">Master Supplier</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="master-user.php">
              <i class="ni ni-single-02 text-orange"></i>
              <span class="nav-link-text">Master User</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="master-admin.php">
              <i class="ni ni-single-02 text-blue"></i>
              <span class="nav-link-text">Master Admin</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="master-pembelian.php">
              <i class="ni ni-bullet-list-67 text-blue"></i>
              <span class="nav-link-text">Transaksi Pembelian</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="master-keluar.php">
              <i class="ni ni-bullet-list-67 text-orange"></i>
              <span class="nav-link-text">Barang Keluar</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="barang-keluar.php">
              <i class="ni ni-book-bookmark text-red"></i>
              <span class="nav-link-text">Laporan Penjualan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="asset-toko.php">
              <i class="ni ni-book-bookmark text-blue"></i>
              <span class="nav-link-text">Nilai Asset Toko</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
