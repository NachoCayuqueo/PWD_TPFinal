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
//TODO: si se borra el ultimo item, se debe borrar compra
$response = $objetoCompraItem->eliminarItem($param);

echo json_encode($response);
