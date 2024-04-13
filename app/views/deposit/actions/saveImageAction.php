<?php
include_once '../../../../config/configuration.php';

$datos = data_submitted();
$tipo = $datos['tipo'];

$objArchivo = new SubirArchivos();
$response = array();

if ($_FILES['miArchivo']['error'] <= 0) {
    $nombreImagen = $_FILES["miArchivo"]["name"];
    $rutaTemporal = $_FILES["miArchivo"]["tmp_name"];
    $respuesta = $objArchivo->SubirImagen($nombreImagen, $rutaTemporal, $tipo);
    if ($respuesta) {
        $response = array('title' => 'EXITO', 'message' => 'La imagen se guardo exitosamente');
    } else {
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar guardar la imagen');
    }
} else {
    $response = array('title' => 'ERROR', 'message' => 'Error al obtener la imagen enviada');
}
// Convertir el array a formato JSON
echo json_encode($response);
