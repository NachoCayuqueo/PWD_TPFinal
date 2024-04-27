<?php
include_once '../../../../config/configuration.php';
$objetoCompraEstado = new AbmCompraEstado();
$response = array();
$data = data_submitted();
$idCompra = $data['idCompra'];

$estadoAceptado = 3;
$cambioExitoso = $objetoCompraEstado->cambiarEstadoCompra($idCompra, $estadoAceptado);
$estadoEnviado = 4;
$cambioExitoso = $objetoCompraEstado->cambiarEstadoCompra($idCompra, $estadoEnviado);
if ($cambioExitoso)
    $response = array('title' => 'EXITO', 'message' => 'La compra fue autorizada y enviada al cliente');
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar autorizar la compra');
// Convertir el array a formato JSON
echo json_encode($response);
