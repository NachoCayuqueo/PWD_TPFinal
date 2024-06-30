<?php
include_once '../../../../config/configuration.php';

$objetoCompra = new AbmCompra();
$compras = $objetoCompra->obtenerDetallesCompras();
// viewStructure($compras);

if (!empty($compras)) {
    // $listaRoles = $objetoRol->toArray($listaRoles);
    $response = array('title' => 'EXITO', 'listaCompras' => $compras);
} else {
    $response = array('title' => 'ERROR', 'listaCompras' => []);
}


echo json_encode($response);
