<?php
session_start();

$num_array = $_GET['id'];

$_SESSION['quantity'][$num_array]--;

if ($_SESSION['quantity'][$num_array] == 0) {
  unset($_SESSION['item_id'][$num_array]);
  unset($_SESSION['quantity'][$num_array]);
  unset($_SESSION['price'][$num_array]);
}

header('location:../add-purchase.php');
