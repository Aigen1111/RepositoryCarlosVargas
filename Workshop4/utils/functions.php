<?php
function getConnection() {
  // Conexión al puerto 3307, sin contraseña
  $connection = mysqli_connect('localhost:3307', 'root', '0411', 'workshop4');
  if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
  }
  return $connection;
}

function saveUser($user): bool {
  $firstName = $user['firstName'];
  $lastName = $user['lastName'];
  $email = $user['email'];
  $provinceId = $user['province_id'];
  $password = password_hash($user['password'], PASSWORD_BCRYPT); // Encriptar la contraseña

  $conn = getConnection();
  
  // Preparar el statement con placeholders
  $sql = "INSERT INTO users (name, lastname, username, province_id, password) 
          VALUES (?, ?, ?, ?, ?)";
  
  $stmt = mysqli_prepare($conn, $sql);
  
  if ($stmt === false) {
      die('MySQL prepare statement failed: ' . mysqli_error($conn));
  }

  // Vincular parámetros
  mysqli_stmt_bind_param($stmt, 'sssis', $firstName, $lastName, $email, $provinceId, $password);

  // Ejecutar la declaración
  if (!mysqli_stmt_execute($stmt)) {
      echo 'Error executing statement: ' . mysqli_stmt_error($stmt);
      mysqli_stmt_close($stmt);
      return false;
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  return true;
}


function authenticate($username, $password) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        return false; // User not found
    }

    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false; // Password is incorrect
    }
}

function getProvinces() {
    return [
        1 => 'Provincia 1',
        2 => 'Provincia 2',
        3 => 'Provincia 3',
        4 => 'Provincia 4'
    ];
}
?>
