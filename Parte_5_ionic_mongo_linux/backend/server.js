const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors'); // Importa el paquete cors

// Conexión a la base de datos MongoDB
mongoose.connect('mongodb://localhost:27017/miBaseDeDatos', {
  useNewUrlParser: true,
  useUnifiedTopology: true
})
.then(() => console.log('Conexión a la base de datos establecida'))
.catch(err => console.error('Error al conectar a la base de datos:', err));

// Definir el esquema del modelo de Producto
const productoSchema = new mongoose.Schema({
  id: Number,
  nombre: String,
  precio: Number,
  cantidad: Number
});

// Definir el modelo de Producto
const Producto = mongoose.model('Producto', productoSchema);

// Crear una instancia de Express
const app = express();
const PORT = 3000;

// Middleware para parsear JSON
app.use(express.json());
// Agregar el middleware cors
app.use(cors());

// Ruta para obtener todos los productos
app.get('/productos', async (req, res) => {
  try {
    const productos = await Producto.find();
    res.json(productos);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Ruta para agregar un nuevo producto
app.post('/productos', async (req, res) => {
  const producto = new Producto({
    id: req.body.id,
    nombre: req.body.nombre,
    precio: req.body.precio,
    cantidad: req.body.cantidad
  });

  try {
    const nuevoProducto = await producto.save();
    res.status(201).json(nuevoProducto);
  } catch (error) {
    res.status(400).json({ message: error.message });
  }
});

// Ruta para eliminar un producto por su ID
app.delete('/productos/:id', async (req, res) => {
  try {
    await Producto.deleteOne({ _id: req.params.id });
    res.json({ message: 'Producto eliminado exitosamente' });
  } catch (error) {
    res.status(404).json({ message: error.message });
  }
});


// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor iniciado en el puerto ${PORT}`);
});
