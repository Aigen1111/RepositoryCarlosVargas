<?php
require('utils/functions.php');

if ($_POST && isset($_POST['email'], $_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Intentar autenticar al usuario
  $user = authenticateUser($email, $password);

  if ($user) {
    // Si la autenticación es exitosa, actualizar la fecha de último inicio de sesión
    updateLastLogin($user['id']);

    // Redirigir a la página de usuarios u otra página del sistema
    header("Location: users.php");
  } else {
    // Si falla, redirigir de vuelta al login con un mensaje de error
    header("Location: login.php?error=invalid_credentials");
  }
}
?>
