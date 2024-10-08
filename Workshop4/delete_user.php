<?php
require 'utils/functions.php';

if (!isset($_GET['id'])) {
  header('Location: /Workshop4/users.php');
  exit();
}

$id = $_GET['id'];
$conn = getConnection();

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
  header('Location: /Workshop4/users.php');
} else {
  echo "Error al eliminar el usuario.";
}

$stmt->close();
$conn->close();
?>
