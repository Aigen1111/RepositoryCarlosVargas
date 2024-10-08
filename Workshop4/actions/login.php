<?php
require('../utils/functions.php');

if ($_POST) {
  $username = $_REQUEST['username'];
  $password = $_REQUEST['password'];

  $user = authenticate($username, $password);

  if ($user) {
    session_start();
    $_SESSION['user'] = $user;
    if ($user['is_admin']) {
      header('Location: /Workshop4/users.php');
    } else {
      header('Location: /Workshop4/normal_user.php');
    }
  } else {
    header('Location: /Workshop4/index.php?error=login');
  }
}
?>
