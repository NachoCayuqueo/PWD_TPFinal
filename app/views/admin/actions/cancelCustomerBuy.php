<?php
include_once '../../../../config/configuration.php';
$objetoCompraEstado = new AbmCompraEstado();
$response = array();
$data = data_submitted();
$idCompra = $data['idCompra'];

$estadoCancelado = 5;
$cambioExitoso = $objetoCompraEstado->cambiarEstadoCompra($idCompra, $estadoCancelado);

if ($cambioExitoso) {
    $objetoCompra = new AbmCompra();
    $usuarioCliente = $objetoCompra->buscarComprador($idCompra);

    $param = [
        "nombreDestinatario" => $usuarioCliente->getUsNombre(),
        "emailDestinatario" => $usuarioCliente->getUsMail(),
        "asunto" => "compraCancelada",
    ];
    $response = phpMailer($param);
} else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar cancelar la compra');
// Convertir el array a formato JSON
echo json_encode($response);
