<?php
include_once '../../../../config/configuration.php';

$datos = data_submitted();

$objetoProducto = new AbmProducto();
$idAEliminar = $datos['idProducto'];
$paramProducto = ['idProducto' => $idAEliminar];

$response = $objetoProducto->eliminarProducto($paramProducto);

echo json_encode($response);
