<?php

if (isset($_SESSION['email'])) {
    header("Location: index.php?action=dashboard");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h1>Registro de Usuario</h1>
            <form id="registerForm" method="post" action="index.php?action=register">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
            <div class="mt-3">
                <a href="index.php?action=login">Iniciar Sesión</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var form = this;
            var formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Registro exitoso')) {
                    console.log('Usuario registrado exitosamente');
                    alert('Usuario registrado exitosamente');
                    window.location.href = 'index.php?action=login';
                } else if (data.includes('Correo electrónico ya registrado')) {
                    console.error('Correo electrónico ya registrado');
                    alert('Correo electrónico ya registrado');
                } else {
                    console.error('Error en el registro');
                    alert('Error en el registro');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
