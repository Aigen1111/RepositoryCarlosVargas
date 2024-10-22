<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Scripts Output</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Capitals of Countries</h2>
    <div class="mb-4">
        <?php
            // Incluir el script para mostrar capitales y países
            include 'scripts/capitals.php';
        ?>
    </div>

    <h2>Temperature Analysis</h2>
    <div class="mb-4">
        <?php
            // Incluir el script para análisis de temperaturas
            include 'scripts/temperatures.php';
        ?>
    </div>
</body>
</html>
