<?php

if (!isset($_SESSION['email'])) {
    header("Location: index.php?action=login");
    exit();
}
$nombreUsuario = $_SESSION['nombre_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h1>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!</h1>
            <a href="index.php?action=logout" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>
