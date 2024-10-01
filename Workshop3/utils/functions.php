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

  $conn = getConnection();
  
  // Preparar el statement con placeholders
  $sql = "INSERT INTO users (firstName, lastName, email, province_id, password) 
          VALUES (?, ?, ?, ?, ?)";
  
  $stmt = mysqli_prepare($conn, $sql);
  
  if ($stmt === false) {
    die('MySQL prepare statement failed: ' . mysqli_error($conn));
  }
  
  // Vincular los parámetros a los placeholders
  mysqli_stmt_bind_param($stmt, 'sssds', $firstName, $lastName, $email, $provinceId, $password);
  
  // Ejecutar el statement
  if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    return true;
  } else {
    mysqli_stmt_close($stmt);
    return false;
  }
}

