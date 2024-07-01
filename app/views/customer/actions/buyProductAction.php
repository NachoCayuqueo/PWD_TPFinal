<?php
include_once '../../../../config/configuration.php';

$data = data_submitted();
$idProducto = $data['idProducto'];

$objetoProducto = new AbmProducto();
$datosProducto = $objetoProducto->obtenerDatosProductos($idProducto);;
if (!is_null($datosProducto)) {
    $response = array('title' => 'EXITO', 'message' => 'Producto encontrado.', 'productData' => $datosProducto);
} else {
    $response = array('title' => 'ERROR', 'message' => 'No se encontro el producto.', 'productData' => []);
}

echo json_encode($response);
