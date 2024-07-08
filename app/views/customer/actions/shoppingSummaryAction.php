<?php
include_once '../../../../config/configuration.php';

$session = new Session();

//$esUsuarioValido = $session->validarUsuario();
$listaCompra = [];

$usuario = $session->getUsuario();
$idUsuarioActivo = $usuario->getIdUsuario();
$param = ['idUsuario' => $idUsuarioActivo];
$objetoCompra = new AbmCompra();
$listaCompra = $objetoCompra->obtenerCompras($param);

if (!is_null($listaCompra)) {
    $response = array('title' => 'EXITO', 'message' => 'Compras encontradas.', 'shoppingList' => $listaCompra);
} else {
    $response = array('title' => 'ERROR', 'message' => 'No se encontraron compras.', 'shoppingList' => []);
}

echo json_encode($response);
