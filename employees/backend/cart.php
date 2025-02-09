<?php
session_start();
include("../../database/config.php");

if (isset($_POST['item_id'])) {
  $no = 0;
  $item_id = $_POST['item_id'];
  $quantity = $_POST['quantity'];

  foreach ($_SESSION['item_id'] as $row => $id_temporary) {
    if ($id_temporary == $item_id) {
      $row = $no;
      $no += 1;

      $item_id = $id_temporary;
      $temporary_total = $_SESSION['quantity'][$row] + $quantity;

      break;
    } else {
      $row = null;

      $item_id = $_POST['item_id'];
      $quantity = $_POST['quantity'];
    }
  }
} else {
  $item_id = $_GET['id'];
  @$row = $_GET['row'];
  $quantity = 1;
  $temporary_total = $_SESSION['quantity'][@$row] + 1;
}

$data = $mysqli->query("SELECT * FROM tb_item as tbi 
JOIN tb_item_in as tbii ON tbii.item_id=tbi.id 
WHERE tbii.item_id='$item_id' AND total_in!=0")->fetch_object();

if (@$_SESSION['quantity'][$row] >= $data->quantity) {
  echo "<script>alert('Upps request over stock!');</script>";
  echo "<script>location='../add-selling.php';</script>";
} else {
  if (isset($_SESSION['quantity'][@$row])) {
    if ($_SESSION['quantity'][@$row] >= $data->quantity) {
      echo "<script>alert('Upps request over stock!');</script>";
      echo "<script>location='../add-selling.php';</script>";
    } elseif ($temporary_total <= $data->quantity) {
      $_SESSION['quantity'][$row] += $quantity;
      echo "<script>location='../add-selling.php';</script>";
    } else {
      $_SESSION['quantity'][$row] += 1;
      echo "<script>location='../add-selling.php';</script>";
    }
  } else {
    if ($data->quantity < $quantity) {
      echo "<script>alert('Upps request over stock!');</script>";
      echo "<script>location='../add-selling.php';</script>";
    } else {
      array_push($_SESSION['item_id'], $item_id);
      array_push($_SESSION['quantity'], $quantity);
      array_push($_SESSION['price'], $data->price + 1500);
      header('location:../add-selling.php');
    }
  }
}
