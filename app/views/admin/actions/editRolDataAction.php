<?php
include_once '../../../../config/configuration.php';
// echo ("ESTOY EN EDITROLDATAACTION");
$objetoRol = new AbmRol();

$data = data_submitted();

$response = array();

$idRol = $data['idRol'];
$nombreRol = $data['nombreRol'];

$modificacionExitosa = $objetoRol->actualizarRol($idRol, $nombreRol);
if ($modificacionExitosa)
    $response = array('title' => 'EXITO', 'message' => 'El Rol fue editado correctamente');
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el rol con id: ' . $data['idRol']);

// Convertir el array a formato JSON
// viewStructure($response);
echo json_encode($response);
