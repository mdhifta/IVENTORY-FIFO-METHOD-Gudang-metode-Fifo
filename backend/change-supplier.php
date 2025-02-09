<?php
include('../database/config.php');

$supplier_name = $_POST['nsupplier'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$id = $_POST['id'];

if ($mysqli->query("UPDATE tb_supplier SET name='$supplier_name', address='$address', phone='$phone' WHERE id='$id'")) {
  header('Location:../admin/supplier.php');
} else {
  echo "query error";
}
