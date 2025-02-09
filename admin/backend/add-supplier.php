<?php
session_start();

if (isset($_POST['supplier_id'])) {
  $_SESSION['supplier_id'] = $_POST['supplier_id'];
  $_SESSION['item_id'] = array();
  $_SESSION['quantity'] = array();
  $_SESSION['price'] = array();

  header('Location:../add-purchase.php');
}
