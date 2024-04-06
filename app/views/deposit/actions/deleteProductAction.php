<?php
include_once '../../../../config/configuration.php';

$datos = data_submitted();

$objetoProducto = new AbmProducto();
$idAEliminar = $datos['idProducto'];
$paramProducto = ['idProducto' => $idAEliminar];

$eliminarProdExito = $objetoProducto->eliminarProducto($paramProducto);

if ($eliminarProdExito) {
    $response = array('title' => 'EXITO', 'message' => 'Se elimino el producto con el id: ' . $idAEliminar);
} else {
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al dar de baja el producto con id: ' . $idAEliminar);
}
echo json_encode($response);
