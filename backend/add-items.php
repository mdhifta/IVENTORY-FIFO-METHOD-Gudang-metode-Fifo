<?php
include('../database/config.php');

$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];
$unit_type = $_POST['unit_type'];

if ($mysqli->query("INSERT INTO tb_item(item_name, quantity, purchase_price, selling_price, unit_type) VALUES('$item_name', '$quantity', '0', '0', '$unit_type')")) {
  header('Location:../admin/master-item.php');
} else {
  echo "query error";
}
