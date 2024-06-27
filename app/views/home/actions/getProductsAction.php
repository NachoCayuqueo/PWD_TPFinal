<?php
include_once '../../../../config/configuration.php';

$data = data_submitted();
$productType = $data['productType'];

$objetoProducto = new AbmProducto();

$productos = $objetoProducto->obtenerProductosSimilares($productType);
$nombreTipoProducto = $objetoProducto->obtenerNombreTipo($productType);
if ($productos) {
    $response = array('title' => 'EXITO', 'typeName' => $nombreTipoProducto, 'message' => 'Productos encontrados.', 'products' => $productos);
} else {
    $response = array('title' => 'ERROR', 'typeName' => $nombreTipoProducto, 'message' => 'No hay productos registrados.', 'products' => []);
}


// Convertir el array a formato JSON
echo json_encode($response);
