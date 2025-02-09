<?php
ini_set('display_errors', 1);

$host = "localhost";
$username = "mdhifta";
$password = "shoera";
$db_name = "db_en_fifo";

$mysqli = new mysqli($host, $username, $password, $db_name);

function koneksi(){
  if ($mysqli) {
    echo "Success connect with ".$db_name;
  } else {
    echo "Failed connnect with ".$db_name;
  }
}


?>
