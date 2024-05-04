<?php
include_once '../../../../config/configuration.php';
$objetoCompraEstado = new AbmCompraEstado();
$response = array();
$data = data_submitted();
$idCompra = $data['idCompra'];
$obj_compra = new AbmCompra();

$usuario = $obj_compra->buscarComprador($idCompra);
$usuarioMail = $usuario->getUsMail();
$usuarioNombre = $usuario->getUsNombre();

$estadoAceptado = 3;
$cambioExitoso = $objetoCompraEstado->cambiarEstadoCompra($idCompra, $estadoAceptado);
$estadoEnviado = 4;
$cambioExitoso = $objetoCompraEstado->cambiarEstadoCompra($idCompra, $estadoEnviado);
if ($cambioExitoso)

    $response = phpMailer($usuarioNombre, $usuarioMail, 'compraAprobada');
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar autorizar la compra');
//Convertir el array a formato JSON
echo json_encode($response);
