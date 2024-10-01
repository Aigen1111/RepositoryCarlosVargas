<?php
require('utils/functions.php');

if ($_POST && isset($_REQUEST['firstName'])) {
  // Obtener los campos del formulario y guardarlos en la base de datos
  $user['firstName'] = $_REQUEST['firstName'];
  $user['lastName'] = $_REQUEST['lastName'];
  $user['email'] = $_REQUEST['email'];
  $user['province_id'] = $_REQUEST['province'];
  $user['password'] = $_REQUEST['password'];
  
  if (saveUser($user)) {
    header("Location: /Workshop3");
  } else {
    header("Location: /Workshop3?error=true");
  }
}
