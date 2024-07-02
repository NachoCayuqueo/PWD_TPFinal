<?php
include_once '../../../../config/configuration.php';

$existeProducto = false;

$objetoProducto = new AbmProducto();
$objetoRol = new AbmRol();
$listaProducto = $objetoProducto->buscar(null);
if (count($listaProducto) > 0) {
    $existeProducto = true;
    $rolesDB = $objetoRol->buscar(null);
}
$listaProducto = $objetoProducto->toArray($listaProducto);
// viewStructure($listaProducto);
if ($existeProducto) {
    $response = array('title' => 'EXITO', 'listaProducto' => $listaProducto, 'existeProducto' => $existeProducto);
} else {
    $response = array('title' => 'ERROR', 'listaProducto' => [], 'existeProducto' => $existeProducto);
}


echo json_encode($response);
