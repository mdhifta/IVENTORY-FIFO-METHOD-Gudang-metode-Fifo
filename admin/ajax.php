<?php
session_start();
include '../database/config.php';

if ($_POST['id']) {
  $id = $_POST['id'];
  if ($id == 0) {
    echo "Nothing price to show";
  } else {
    $data = $mysqli->query("SELECT id FROM tb_item_in WHERE item_id='$id' AND total_in!='0' ORDER BY id ASC")->fetch_object();
    $_SESSION['item_in_id'] = $data->id;
  }
}
