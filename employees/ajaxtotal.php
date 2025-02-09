<?php
session_start();
include '../database/config.php';

if ($_POST['id']) {
  $id = $_POST['id'];
  if ($id == 0) {
    echo "Not price to show";
  } else {
    $item_in_id = $_SESSION['item_in_id'];
    $price = $mysqli->query("SELECT price FROM tb_item_in WHERE id='$item_in_id'")->fetch_object();
    $selling_price = $price->price + 1500;

    echo '<label class="form-control-label" for="input-first-name">Total Payment : Rp. ' . number_format($selling_price * $id) . ';-</label>';
  }
  $_SESSION['$item_id'] = 0;
}
