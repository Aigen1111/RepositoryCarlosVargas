<?php

/**
 *  Gets the provinces from the database
 */
function getProvinces() {
  $conn = getConnection();
  $sql = "SELECT id, name FROM provinces";
  $result = mysqli_query($conn, $sql);
  
  $provinces = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $provinces[$row['id']] = $row['name'];
  }
  
  return $provinces;
}

function getConnection() {
  // Conexión al puerto 3307, sin contraseña
  $connection = mysqli_connect('localhost:3307', 'root', '0411', 'workshop3');
  if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
  }
  return $connection;
}

/**
 * Saves a specific user into the database
 */
function saveUser($user) {
  $firstName = $user['firstName'];
  $lastName = $user['lastName'];
  $email = $user['email'];
  $provinceId = $user['province_id'];
  $password = password_hash($user['password'], PASSWORD_BCRYPT); // Encriptar la contraseña
  $status = 'active';
  $lastLoginDatetime = date('Y-m-d H:i:s'); // Fecha y hora actual del sistema

  $conn = getConnection();
  
  // Preparar el statement con placeholders
  $sql = "INSERT INTO users (firstName, lastName, email, province_id, password, status, last_login_datetime) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";
  
  $stmt = mysqli_prepare($conn, $sql);
  
  if ($stmt === false) {
    die('MySQL prepare statement failed: ' . mysqli_error($conn));
  }
  
  // Vincular los parámetros a los placeholders
  mysqli_stmt_bind_param($stmt, 'sssisss', $firstName, $lastName, $email, $provinceId, $password, $status, $lastLoginDatetime);
  
  // Ejecutar el statement
  if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    return true;
  } else {
    mysqli_stmt_close($stmt);
    return false;
  }
}


function authenticateUser($email, $password) {
  $conn = getConnection();
  
  // Verificar que el usuario esté activo y tenga el email ingresado
  $sql = "SELECT * FROM users WHERE email = ? AND status = 'active'";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 's', $email);
  mysqli_stmt_execute($stmt);
  
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);
  
  if ($user && password_verify($password, $user['password'])) {
    return $user; // Devolver datos del usuario si la autenticación es exitosa
  }
  
  return false; // Fallar autenticación si no coincide
}


function updateLastLogin($userId) {
  $conn = getConnection();
  $lastLoginDatetime = date('Y-m-d H:i:s');
  
  $sql = "UPDATE users SET last_login_datetime = ? WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'si', $lastLoginDatetime, $userId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}
