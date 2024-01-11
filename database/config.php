<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "db_fifo";

$mysqli = new mysqli($host, $username, $password, $db_name);

function koneksi(){
  if ($mysqli) {
    echo "Berhasil terkoneksi pada database ".$db_name;
  } else {
    echo "Gagal Terkoneksi";
  }
}


?>
