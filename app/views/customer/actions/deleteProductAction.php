<?php
include_once '../../../../config/configuration.php';

$objetoCompraItem = new AbmCompraItem();
$data = data_submitted();
$response = array();

$idCompra = $data['idCompra'];
$idProducto = $data['idProducto'];

$param = [
    'idCompra' => $idCompra,
    'idProducto' => $idProducto
];
$itemProducto = $objetoCompraItem->buscar($param);

if (!empty($itemProducto)) {
    $paramId = ['idCompraItem' => $itemProducto[0]->getIdCompraItem()];
    $bajaExitosa = $objetoCompraItem->baja($paramId);
    if ($bajaExitosa)
        $response = array('title' => 'EXITO', 'message' => 'El producto fue eliminado del carrito');
    else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar eliminar el producto del carrito');
} else {
    $response = array('title' => 'ERROR', 'message' => 'Producto no encontrado');
}

echo json_encode($response);
