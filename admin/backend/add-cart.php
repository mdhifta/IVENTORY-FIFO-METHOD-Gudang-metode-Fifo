<?php
session_start();
include("../../database/config.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  $id = $_POST['item_id'];
}

foreach ($_SESSION['item_id'] as $num_array => $item_id) {
  if ($num_array == $id) {
    $_SESSION['quantity'][$num_array] += 1;
    $cek = 1;
    break;
  } else {
    $cek = 0;
  }
}

if ($cek == 0) {
  array_push($_SESSION['item_id'], $_POST['item_id']);
  array_push($_SESSION['quantity'], $_POST['quantity']);
  array_push($_SESSION['price'], $_POST['price']);
  header("Location:../add-purchase.php");
} else {
  header("Location:../add-purchase.php");
}
