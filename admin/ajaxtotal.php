<?php
session_start();
include '../database/config.php';

if ($_POST['id']) {
  $id = $_POST['id'];
  if ($id == 0) {
    echo "Nothing set Price";
  } else {
    $item_in_id = $_SESSION['item_in_id'];

    $query = $mysqli->query("SELECT price FROM tb_purchase WHERE item_in_id='$item_in_id'");
    $price = $query->fetch_object();
    $price_total = $price->price + 1500;
    echo '<label class="form-control-label" for="input-first-name">Total Payment : Rp. ' . number_format($price_total * $id) . ';-</label>';
  }
  $_SESSION['item_id'] = 0;
}
