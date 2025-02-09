<?php
include('../database/config.php');

$id = $_POST['id'];
$item_name = $_POST['item_name'];
$unit_type = $_POST['unit_type'];

if ($mysqli->query("UPDATE tb_item SET item_name='$item_name', unit_type='$unit_type' WHERE id='$id'")) {
  header('Location:../admin/master-item.php');
} else {
  echo "query error";
}
