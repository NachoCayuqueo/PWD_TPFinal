<?php
include_once '../../../../config/configuration.php';

$session = new Session();
$existeSesion = false;
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (!is_null(($usuario))) {
        $idUsuarioActivo = $usuario->getIdUsuario();
    }
}
$data = data_submitted();
$idProducto = $data['idProducto'];

$objetoProducto = new AbmProducto();
$datosProducto = $objetoProducto->obtenerDatosProductos($idProducto);;
if (!is_null($datosProducto)) {
    $response = array('title' => 'EXITO', 'message' => 'Producto encontrado.', 'productData' => $datosProducto, 'idUsuario' => $idUsuarioActivo);
} else {
    $response = array('title' => 'ERROR', 'message' => 'No se encontro el producto.', 'productData' => [], 'idUsuario' => $idUsuarioActivo);
}

echo json_encode($response);
