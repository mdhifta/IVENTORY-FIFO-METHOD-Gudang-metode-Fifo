<?php
include('../database/config.php');

$name = $_POST['name'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$query = $mysqli->query("SELECT * FROM tb_employees WHERE username='$username'");
$selection = $query->num_rows;

$query2 = $mysqli->query("SELECT * FROM tb_employees WHERE email='$email'");
$selection2 = $query2->num_rows;

if ($selection!=1 && $selection2!=1) {
  if($mysqli->query("INSERT INTO tb_employees(name, phone, username, password, email) VALUES('$name', '$phone', '$username', '$password', '$email')")) {
    header('Location:../admin/master-user.php');
  } else {
    echo "query error";
  }
} else {
  header('Location:../admin/add-user.php?id=1');
}
?>
