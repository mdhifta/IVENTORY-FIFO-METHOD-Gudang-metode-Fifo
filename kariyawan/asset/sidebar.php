<?php
session_start();
include("../database/config.php");
$id_kariyawan = $_SESSION['id_kariyawan'];
$query = $mysqli->query("SELECT * FROM tb_kariyawan WHERE id_kariyawan='$id_kariyawan'");

$kariyawan = $query->fetch_object();

if ($_SESSION['id_kariyawan'] == '') {
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
                        <a class="nav-link" href="add-penjualan.php">
                            <i class="ni ni-bullet-list-67 text-green"></i>
                            <span class="nav-link-text">Penjualan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="master-item.php">
                            <i class="ni ni-app text-blue"></i>
                            <span class="nav-link-text">Detail Barang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="barang-keluar.php">
                            <i class="ni ni-book-bookmark text-orange"></i>
                            <span class="nav-link-text">Laporan Penjualan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>