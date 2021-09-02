<?php
  include('../../database/config.php');

  $id = $_POST['id'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];

  if ($password1==$password2) {
    if ($mysqli->query("UPDATE tb_kariyawan SET password='$password1' WHERE id_kariyawan='$id'")) {
      header("Location:../../index.php");
    }
  }
 ?>
