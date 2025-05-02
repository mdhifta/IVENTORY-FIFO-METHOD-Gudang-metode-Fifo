<?php
session_start();
include("../database/config.php");
$employee_id = $_SESSION['employee_id'];
$employee = $mysqli->query("SELECT * FROM tb_employees WHERE id='$employee_id'")->fetch_object();
if ($_SESSION['employee_id'] == '') {
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
                        <a class="nav-link" href="add-selling.php?deactive_jquery=1">
                            <i class="ni ni-bullet-list-67 text-green"></i>
                            <span class="nav-link-text">Selling</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="master-item.php">
                            <i class="ni ni-app text-blue"></i>
                            <span class="nav-link-text">Master Item</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report-out-item.php">
                            <i class="ni ni-book-bookmark text-orange"></i>
                            <span class="nav-link-text">Report Selling</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>