<?php
include('../database/config.php');

$item_id = $_POST['item_id'];
$item_in_id = $_POST['id'];
$supplier_id = $_POST['supplier_id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

$last_stock = $_POST['last_stock'];

$query = $mysqli->query("SELECT * FROM tb_item WHERE id='$item_id'");
$data = $query->fetch_object();

$new_quantity = $data->quantity - $last_stock;

if ($mysqli->query("UPDATE tb_item_in SET item_id='$item_id', total_in='$quantity', price='$price' WHERE id='$item_in_id'")) {
  if ($mysqli->query("UPDATE tb_purchase SET supplier_id='$supplier_id', purchase_total='$quantity' WHERE item_in_id='$item_in_id'")) {
    if ($mysqli->query("UPDATE tb_item SET quantity=$new_quantity+$quantity WHERE id='$item_id'")) {
      header('Location:../admin/master-purchase.php');
    } else {
      echo "error update item";
    }
  } else {
    echo "Failed to insert data tb_purchase";
  }
} else {
  echo "query error";
}
