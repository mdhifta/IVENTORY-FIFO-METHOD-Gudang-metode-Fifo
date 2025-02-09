<?php
session_start();
include('../database/config.php');

$username = $_POST['username'];
$password = $_POST['password'];

# check admin
$query_admin = $mysqli->query("SELECT * FROM tb_admin WHERE username='$username' AND password='$password'");
$admin = $query_admin->num_rows;

#check employess
$query_employees = $mysqli->query("SELECT * FROM tb_employees WHERE username='$username' AND password='$password'");
$employees = $query_employees->num_rows;

if ($admin == 1) {
  $data = $query_admin->fetch_object();

  $employees = 1;
  $_SESSION['admin_id'] = $data->id;

  header('Location:../admin/dashboard.php');
} else {
  $data = $query_employees->fetch_object();

  $admin = 1;
  $_SESSION['employee_id'] = $data->id;
  $_SESSION['item_id'] = array();
  $_SESSION['quantity'] = array();
  $_SESSION['price'] = array();

  header('Location:../employees/dashboard.php');
}

if ($admin == 0) {
  header("Location:../index.php?id=1");
} elseif ($employees == 0) {
  header("Location:../index.php?id=1");
}
