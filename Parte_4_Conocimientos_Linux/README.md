# Parte 4: Script de MongoDB - Explicación paso a paso

En este documento, explicaremos cómo crear y ejecutar un script en Bash para interactuar con MongoDB. El script creará una base de datos, una colección y realizará algunas operaciones básicas, como insertar documentos y consultar datos.

## Paso 1: Crear un archivo con extencion .sh

Guarde el script en un archivo con extensión `.sh`, por ejemplo, `mongo_script.sh`.

## Paso 2: Dar permisos de ejecución al script

Abra una terminal y navegue hasta el directorio donde se encuentra el script. Luego, ejecute el siguiente comando para dar permisos de ejecución al script:  `chmod +x mongo_script.sh`

## Paso 3: Copie y pegue el siguiente codigo

```bash

Abre tu editor de texto preferido y copia el siguiente código:

```bash
#!/bin/bash

# Función para inicializar la base de datos y la colección
inicializarBaseDeDatos() {
    echo "Inicializando la base de datos y la colección..."
    # Conectarse a MongoDB y crear la base de datos y la colección si no existen
    if mongo <<EOF
        use miBaseDeDatos

        db.createCollection("productos")

        db.productos.insertMany([
            { id: 1, nombre: "Producto 1", precio: 10, cantidad: 100 },
            { id: 2, nombre: "Producto 2", precio: 20, cantidad: 150 },
            { id: 3, nombre: "Producto 3", precio: 30, cantidad: 200 }
        ])
EOF
    then
        echo "La base de datos y la colección se han creado exitosamente."
    else
        echo "Error: No se pudo inicializar la base de datos y la colección." >&2
        exit 1
    fi
}

# Función para obtener el precio de un producto por su nombre
getPrecioProducto() {
    local nombre="$1"
    local precio=$(mongo --quiet --eval "db.productos.findOne({nombre: '$nombre'}).precio")
    if [ -n "$precio" ]; then
        echo "El precio de $nombre es: $precio"
    else
        echo "Error: No se encontró el producto '$nombre'." >&2
        exit 1
    fi
}

# Función principal
main() {
    # Inicializar la base de datos y la colección
    inicializarBaseDeDatos

    # Ejemplo de uso de la función getPrecioProducto
    echo "Obteniendo el precio del Producto 2..."
    getPrecioProducto "Producto 2"
}

# Llamar a la función principal
main




