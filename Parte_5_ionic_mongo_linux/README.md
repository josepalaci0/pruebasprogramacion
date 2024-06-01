# Prueba de Conocimientos para Desarrollador de Software Perfil 2 , Parte 5: Proyecto Ionic - Gestión de Productos 

## Descripción

Este proyecto es una aplicación móvil desarrollada con Ionic que permite gestionar una lista de productos almacenados en una base de datos MongoDB. La aplicación permite agregar nuevos productos, eliminar productos existentes y listar todos los productos almacenados en la base de datos.

## Requisitos

Asegúrate de tener instalados los siguientes requisitos antes de comenzar:
- Conocimietos moderados en LINUX
- Node.js y npm: [Descargar e instalar Node.js](https://nodejs.org/)
- MongoDB: [Instrucciones de instalación de MongoDB](https://docs.mongodb.com/manual/installation/)
- Ionic Framework: [Instrucciones de instalación de Ionic](https://ionicframework.com/docs/intro/cli)

## Instalación

1. Clona este repositorio en tu máquina local:

   ```bash
   git clone https://github.com/josepalaci0/appionic.git

## Importante 

1. El Proyecto funciona con un sistema API-HTTP, debes arrancar el Frontend y el backend , por separado en diferentes puertos.
2. se toma encuenta , que se trabajara con typeScript, y se debe comprender en un nivel basico el funcinamiento de Node js. 
3. se tiene presente  , que debes  manejar la consola de linux, para poder arrancar  completo en linux y mongoDB. 

Una vez que hayas configurado e iniciado tanto el backend como el frontend, puedes interactuar con la aplicación siguiendo estos pasos:

### Visualización de Productos

1. Abre tu navegador y navega a `http://localhost:8100`.
2. Deberías ver una lista de productos que han sido cargados desde la base de datos MongoDB.
3. Si no hay productos en la base de datos, la lista estará vacía.

### Agregar un Nuevo Producto

1. En la parte inferior de la página, encontrarás un formulario para agregar un nuevo producto.
2. Rellena los campos "Product Name", "Product Price" y "Product Quantity".
3. Haz clic en el botón "Add Product".
4. El nuevo producto se agregará a la base de datos y se mostrará en la lista de productos.

### Eliminar un Producto

1. En la lista de productos, cada producto tiene un botón "Delete" al lado.
2. Haz clic en el botón "Delete" para el producto que deseas eliminar.
3. El producto será eliminado de la base de datos y desaparecerá de la lista de productos.

### Notificaciones

1. Cuando agregues o elimines un producto, se mostrará una notificación en la parte inferior de la pantalla indicando si la operación fue exitosa o si hubo algún error.


## Requisitos

Antes de ejecutar la aplicación, asegúrate de tener instalados los siguientes requisitos:

### Requisitos del Backend

1. **Node.js**: Asegúrate de tener Node.js instalado en tu sistema. Puedes descargarlo e instalarlo desde [nodejs.org](https://nodejs.org/).
2. **MongoDB**: Necesitarás tener MongoDB instalado y en ejecución. Puedes descargarlo e instalarlo desde [mongodb.com](https://www.mongodb.com/). También puedes usar un servicio de base de datos en la nube como MongoDB Atlas.
3. **Dependencias del Backend**: Navega a la carpeta del backend y ejecuta `sudo npm install` para instalar las dependencias necesarias.

### Requisitos del Frontend

1. **Node.js**: Asegúrate de tener Node.js instalado en tu sistema (mismo que para el backend).
2. **Ionic CLI**: Instala la Ionic CLI globalmente ejecutando `sudo npm install -g @ionic/cli`.
3. **Dependencias del Frontend**: Navega a la carpeta del frontend y ejecuta `sudo npm install` para instalar las dependencias necesarias.

### Ejecución

Para ejecutar la aplicación, sigue estos pasos:

1. **Iniciar el Backend**:
   - Navega a la carpeta del backend.
   - Ejecuta `sudo node server.js` para iniciar el servidor.
   - Asegúrate de que el servidor esté corriendo correctamente en `http://localhost:3000`.

2. **Iniciar el Frontend**:
   - debes iniciar el proyecto con los paquetes `sudo npm i` asi se instalan todos los paquetes
   - Navega a la carpeta del frontend.
   - Ejecuta `sudo ionic serve` para iniciar la aplicación Ionic.
   - Abre tu navegador y navega a `http://localhost:8100` para ver la aplicación en funcionamiento.



