<?php
include_once '../../../../config/configuration.php';

$objetoProducto = new AbmProducto();

$data = data_submitted();

$response = [];

$proNombre = $data['nombre'];
$proPrecio = $data['precio'];
$proTipo = $data['tipo'];
$proDescripcion = $data['titulo'];
$proMasInfo = $data['masInfo'];
$proCantStock = $data['stock'];
$esprodestacado = $data['esPopular'];
$espronuevo = $data['esNuevo'];
$proImagen = $data['nombreImg'];

$params = [
    'proNombre' => $proNombre,
    'proPrecio' => $proPrecio,
    'proTipo' => $proTipo,
    'proDescripcion' => $proDescripcion,
    'proMasInfo' => $proMasInfo,
    'proCantStock' => $proCantStock,
    'esprodestacado' => $esprodestacado,
    'espronuevo' => $espronuevo,
    'proImagen' => $proImagen
];

$altaExitosa = $objetoProducto->alta($params);
if ($altaExitosa) {
    $response = array('title' => 'EXITO', 'message' => 'Alta exitosa');
} else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar  dar de alta el producto');

echo json_encode($response);
