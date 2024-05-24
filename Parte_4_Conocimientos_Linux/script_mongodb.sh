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
