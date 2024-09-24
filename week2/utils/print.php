<?php
// Conectar a la base de datos MySQL
$servername = "localhost"; // Nombre del servidor (en XAMPP suele ser localhost)
$username = "root";        // Nombre de usuario (en XAMPP suele ser root)
$password = "";            // Contraseña (en XAMPP normalmente está en blanco)
$dbname = "test_db";       // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Obtener los datos de la solicitud (request)
$name = $_REQUEST['name'];
$lastname = $_REQUEST['lastname'];
$phone = $_REQUEST['phone'];
$mail = $_REQUEST['mail'];

// Preparar la sentencia SQL para insertar los datos
$sql = "INSERT INTO users (name, lastname, phone, mail) VALUES (?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Verificar si la preparación fue exitosa
if ($stmt === false) {
    die("Error preparando la consulta: " . $conn->error);
}

// Vincular los parámetros
$stmt->bind_param("ssss", $name, $lastname, $phone, $mail);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Datos insertados correctamente";
} else {
    echo "Error al insertar los datos: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();


echo"<br>Los datos son:<br>";
echo("<br>The Name is ". $_REQUEST['name']. " ". $_REQUEST['lastname'] );
echo("<br>The phone number is ". $_REQUEST['phone']. " ");
echo("<br>The mail is ". $_REQUEST['mail']. " ");


