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
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h1>Iniciar Sesión</h1>
            <form id="loginForm" method="post" action="index.php?action=login">
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
            <div class="mt-3">
                <a href="index.php?action=register">Registrarse</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var form = this;
            var formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Correo electrónico o contraseña incorrectos')) {
                    console.error('Correo electrónico o contraseña incorrectos');
                    alert('Correo electrónico o contraseña incorrectos');
                } else if (data.includes('dashboard')) {
                    console.log('Usuario logueado');
                    alert('Usuario logueado');
                    window.location.href = 'index.php?action=dashboard';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
