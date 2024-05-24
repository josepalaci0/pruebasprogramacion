import React, { useState, useEffect } from 'react';
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar, IonList, IonItem, IonLabel, IonButton, IonInput, IonItemDivider, IonToast } from '@ionic/react';
import axios from 'axios';

interface Product {
  _id: string;
  nombre: string;
  precio: number;
  cantidad: number;
}

const ProductList: React.FC = () => {
  const [products, setProducts] = useState<Product[]>([]);
  const [name, setName] = useState('');
  const [price, setPrice] = useState('');
  const [quantity, setQuantity] = useState('');
  const [showToast, setShowToast] = useState(false);
  const [toastMessage, setToastMessage] = useState('');
  const [toastColor, setToastColor] = useState('success');

  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async () => {
    try {
      const response = await axios.get<Product[]>('http://localhost:3000/productos');
      setProducts(response.data);
    } catch (error) {
      showErrorToast('Error fetching products.');
    }
  };

  const addProduct = async () => {
    try {
      await axios.post('http://localhost:3000/productos', { nombre: name, precio: parseFloat(price), cantidad: parseInt(quantity) });
      fetchProducts();
      setName('');
      setPrice('');
      setQuantity('');
      showSuccessToast('Product added successfully.');
    } catch (error) {
      showErrorToast('Error adding product.');
    }
  };

  const deleteProduct = async (id: string) => {
    try {
      await axios.delete(`http://localhost:3000/productos/${id}`);
      fetchProducts();
      showSuccessToast('Product deleted successfully.');
    } catch (error) {
      showErrorToast('Error deleting product.');
    }
  };

  const showSuccessToast = (message: string) => {
    setToastMessage(message);
    setToastColor('success');
    setShowToast(true);
  };

  const showErrorToast = (message: string) => {
    setToastMessage(message);
    setToastColor('danger');
    setShowToast(true);
  };

  return (
    <IonPage>
      <IonHeader>
        <IonToolbar color="primary">
          <IonTitle>Product List</IonTitle>
        </IonToolbar>
      </IonHeader>
      <IonContent>
        <IonList>
          {products.map((product) => (
            <IonItem key={product._id}>
              <IonLabel>
                <h2>{product.nombre}</h2>
                <p>Price: ${product.precio}</p>
                <p>Quantity: {product.cantidad} pcs</p>
              </IonLabel>
              <IonButton color="danger" onClick={() => deleteProduct(product._id)}>Delete</IonButton>
            </IonItem>
          ))}
        </IonList>
        <IonItemDivider>Add New Product</IonItemDivider>
        <IonItem>
          <IonInput
            value={name}
            placeholder="Product Name"
            onIonChange={(e) => setName(e.detail.value!)}
          />
        </IonItem>
        <IonItem>
          <IonInput
            value={price}
            placeholder="Product Price"
            type="number"
            onIonChange={(e) => setPrice(e.detail.value!)}
          />
        </IonItem>
        <IonItem>
          <IonInput
            value={quantity}
            placeholder="Product Quantity"
            type="number"
            onIonChange={(e) => setQuantity(e.detail.value!)}
          />
        </IonItem>
        <IonButton expand="full" onClick={addProduct}>Add Product</IonButton>
        <IonToast
          isOpen={showToast}
          message={toastMessage}
          duration={2000}
          color={toastColor}
          onDidDismiss={() => setShowToast(false)}
        />
      </IonContent>
    </IonPage>
  );
};

export default ProductList;
