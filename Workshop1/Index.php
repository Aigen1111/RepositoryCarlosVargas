<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha y Hora Dinámica</title>
</head>
<body>
    <h1>Fecha y Hora Dinámica en PHP</h1>
    <p>
        <?php
            date_default_timezone_set('America/Costa_Rica'); // Ajusta la zona horaria
            echo "La fecha y hora actual es: " . date('d/m/Y H:i:s');
        ?>
    </p>

    <p><a href="">Actualizar Fecha y Hora</a></p> <!-- Enlace para recargar la página -->
</body>
</html>
