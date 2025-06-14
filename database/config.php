<?php
ini_set('display_errors', 1);

$host = "69.10.40.66 ";
$username = "digisoft_master";
$password = "uDa9,SuCu&j+";
$db_name = "digisoft_fifo_en";

$mysqli = new mysqli($host, $username, $password, $db_name);

function koneksi(){
  if ($mysqli) {
    echo "Success connect with ".$db_name;
  } else {
    echo "Failed connnect with ".$db_name;
  }
}


?>
