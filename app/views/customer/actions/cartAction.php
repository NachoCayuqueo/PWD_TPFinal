<?php
include_once '../../../../config/configuration.php';

$objetoCompra = new AbmCompra();
$data = data_submitted();
$response = array();

$idUsuario = $data['idUsuario'];
$idProducto = $data['idProducto'];
$cantProducto = $data['cantProducto'];

$param = [
    'idUsuario' => $idUsuario,
    'idProducto' => $idProducto,
    'cantidad'   => $cantProducto
];
$productoAgregado = $objetoCompra->agregarProductoCarrito($param);

if ($productoAgregado) {
    $response = array('title' => 'EXITO', 'message' => 'Se agrego un producto al carrito');
} else {
    $response = array('title' => 'ERROR', 'message' => 'No se pudo agregar el producto al carrito');
}



echo json_encode($response);
