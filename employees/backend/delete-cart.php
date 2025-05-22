<?php
session_start();

$row = $_GET['id'];
$_SESSION['quantity'][$row]--;

if ($_SESSION['quantity'][$row] == 0) {
  unset($_SESSION['quantity'][$row]);
  unset($_SESSION['item_id'][$row]);
  unset($_SESSION['price'][$row]);
}

header('location:../add-selling.php?deactive_jquery=1');
