<?php
$host = "localhost";
$username = "your_username";
$password = "your_password";
$db_name = "your_db_name";

$mysqli = new mysqli($host, $username, $password, $db_name);

function koneksi(){
  if ($mysqli) {
    echo "Berhasil terkoneksi pada database ".$db_name;
  } else {
    echo "Gagal Terkoneksi";
  }
}


?>
