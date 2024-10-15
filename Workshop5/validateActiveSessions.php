<?php
require('utils/functions.php');

if ($argc < 2) {
    echo "Usage: php validateActiveSessions.php <hours>\n";
    exit(1);
}

$hours = intval($argv[1]);

if ($hours <= 0) {
    echo "Please provide a valid number of hours.\n";
    exit(1);
}

$conn = getConnection();

// Obtener la fecha y hora actual del servidor
$currentDateTime = new DateTime();
$currentDateTimeStr = $currentDateTime->format('Y-m-d H:i:s');

// Calcular la fecha límite basada en las horas proporcionadas
$cutoffDateTime = $currentDateTime->modify("-$hours hours");
$cutoffDateTimeStr = $cutoffDateTime->format('Y-m-d H:i:s');

// Query para actualizar usuarios cuyo `last_login_datetime` sea anterior a la fecha límite
$sql = "UPDATE users 
        SET status = 'inactive' 
        WHERE status = 'active' AND last_login_datetime <= ?";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die('MySQL prepare statement failed: ' . mysqli_error($conn));
}

// Vincular el parámetro y ejecutar el query
mysqli_stmt_bind_param($stmt, 's', $cutoffDateTimeStr);

if (mysqli_stmt_execute($stmt)) {
    echo "Users who haven't logged in for $hours hours or more have been set to inactive.\n";
} else {
    echo "Failed to update users: " . mysqli_stmt_error($stmt) . "\n";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
