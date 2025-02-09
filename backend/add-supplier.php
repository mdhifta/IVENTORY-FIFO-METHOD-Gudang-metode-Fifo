<?php
include('../database/config.php');

$name = $_POST['nsupplier'];
$address = $_POST['address'];
$phone = $_POST['phone'];

if($mysqli->query("INSERT INTO tb_supplier(name, address, phone) VALUES('$name', '$address', '$phone')")) {
  header('Location:../admin/supplier.php');
} else {
  echo "query error";
}
?>
