# Parte 3: Sistema de Autenticación con PHP

Este sistema de autenticación con PHP permite a los usuarios registrarse, iniciar sesión y cerrar sesión. Está construido siguiendo un enfoque de controlador (MVC) y utiliza una base de datos MySQL para almacenar la información del usuario.

## Estructura del Proyecto

El proyecto consta de los siguientes componentes:

- **Controladores**:
  - `AuthController.php`: Maneja la autenticación de usuarios, incluyendo el inicio de sesión y el registro.
  - `UserController.php`: Maneja el registro de nuevos usuarios.
  - `DashboardController.php`: Controla la página de inicio después de iniciar sesión.
  - `LogoutController.php`: Controla el cierre de sesión.

- **Modelos**:
  - `UserModel.php`: Maneja las operaciones de base de datos relacionadas con los usuarios, como la creación de nuevos usuarios, la validación de credenciales y la obtención del nombre de usuario por correo electrónico.

- **Vistas**:
  - `login.php`: El formulario de inicio de sesión.
  - `register.php`: El formulario de registro de nuevos usuarios.
  - `dashboard.php`: La página de inicio después de iniciar sesión.

- **Configuración**:
  - `db.php`: Archivo de configuración para la conexión a la base de datos MySQL.

- **Punto de Entrada**:
  - `index.php`: El punto de entrada principal que dirige las solicitudes a los controladores correspondientes.

## Funcionamiento del Sistema

1. **Registro de Usuario**:
   - El usuario completa el formulario de registro (`register.php`) con su nombre, correo electrónico y contraseña.
   - Los datos se envían al controlador `UserController.php`, que valida los datos y los inserta en la base de datos si son válidos.
   - Si el registro es exitoso, se muestra una alerta de éxito y el usuario es redirigido al formulario de inicio de sesión.

2. **Inicio de Sesión**:
   - El usuario completa el formulario de inicio de sesión (`login.php`) con su correo electrónico y contraseña.
   - Los datos se envían al controlador `AuthController.php`, que valida las credenciales consultando la base de datos.
   - Si las credenciales son correctas, se inicia una sesión y el usuario es redirigido al `Dashboard`.
   - Si las credenciales son incorrectas, se muestra una alerta de error.

3. **Dashboard**:
   - Cuando el usuario inicia sesión correctamente, se redirige al `Dashboard`.
   - El `Dashboard` muestra un mensaje de bienvenida con el nombre del usuario y un botón para cerrar sesión.

4. **Cierre de Sesión**:
   - Al hacer clic en el botón de cerrar sesión en el `Dashboard`, se ejecuta el controlador `LogoutController.php`.
   - Este controlador cierra la sesión del usuario y lo redirige al formulario de inicio de sesión.

## Tecnologías Utilizadas

- PHP: Para el backend y lógica de negocio.
- MySQL: Para el almacenamiento de datos de usuario.
- HTML/CSS/Bootstrap: Para la estructura y el diseño de las páginas web.
- JavaScript: Para la validación de formularios y alertas en el frontend.

## Conclusiones
Este sistema de autenticación proporciona una funcionalidad básica pero esencial para cualquier aplicación web que requiera que los usuarios se registren e inicien sesión. Con la estructura MVC utilizada, el código es modular y fácilmente mantenible, lo que facilita la incorporación de nuevas funcionalidades en el futuro.

## Instrucciones de Instalación y Uso - Autenticación con PHP

### Requisitos Previos:
1. **Servidor Web Local**: Necesitarás un servidor web local instalado en tu máquina. Puedes utilizar XAMPP, WAMP o cualquier otro servidor web que prefieras.
2. **Base de Datos MySQL**: Debes tener un servidor de base de datos MySQL instalado y en funcionamiento en tu máquina.

### Pasos para Configurar y Ejecutar el Proyecto:

1. **Clonar el Repositorio**: Descarga o clona el repositorio que contiene el proyecto PHP desde GitHub o cualquier otro repositorio donde esté alojado.

2. **Configurar el Servidor Web**:
   - Abre el panel de control de tu servidor web local (por ejemplo, XAMPP o WAMP).
   - Asegúrate de que el servidor web y el servidor MySQL estén activos.

3. **Configurar la Base de Datos**:
   - Crea una nueva base de datos MySQL para el proyecto.
   - Importa el archivo de la base de datos proporcionado en el proyecto (`database.sql`) para crear la estructura de la tabla de usuarios.

4. **Configurar la Conexión a la Base de Datos**:
   - Abre el archivo `db.php` en la carpeta `config`.
   - Actualiza las credenciales de conexión (nombre de host, nombre de usuario, contraseña y nombre de la base de datos) con los valores correspondientes de tu entorno.

5. **Iniciar el Servidor Web**:
   - Inicia tu servidor web local desde el panel de control (por ejemplo, XAMPP o WAMP).

6. **Navegar a la Aplicación**:
   - Abre un navegador web e ingresa la URL `http://localhost/tu_ruta_al_proyecto/index.php` en la barra de direcciones, donde `tu_ruta_al_proyecto` es la ubicación donde has colocado el proyecto en tu servidor local.

7. **Registrarse y Iniciar Sesión**:
   - Una vez en la página principal, puedes registrarte como nuevo usuario o iniciar sesión si ya tienes una cuenta.
   - Completa el formulario de registro con tus datos o utiliza el formulario de inicio de sesión si ya tienes una cuenta.

8. **Explorar las Funcionalidades**:
   - Después de iniciar sesión, podrás acceder al panel de control (`dashboard`) y explorar las funcionalidades disponibles.

Con estos pasos, deberías poder probar y ejecutar el ejemplo de autenticación con PHP en un entorno Windows sin problemas. ¡Disfruta explorando la aplicación!

