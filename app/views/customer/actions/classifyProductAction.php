<?php
include_once '../../../../config/configuration.php';

$objetoValoracion = new AbmValoracionProducto();
$data = data_submitted();
$response = array();

$rankingAgregado = $objetoValoracion->cargarValoraciones($data);

if ($rankingAgregado) {
    $response = array('title' => 'EXITO', 'message' => 'Los comentarios fueron agregados exitosamente');
} else {
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al agregar los comentarios');
}

echo json_encode($response);
