<?php
  require('../utils/functions.php');

  if($_POST) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $user = authenticate($username, $password);

    if($user) {
      session_start();
      $_SESSION['user'] = $user;
      header('Location: /users.php');
    } else {
      header('Location: /index.php?error=login');
    }
  }
  require('../utils/functions.php');



