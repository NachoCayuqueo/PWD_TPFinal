<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$response = array();
$data = data_submitted();

$idUsuario = $data['idUsuario'];

$cambioExitoso = $objetoUsuario->activarUsuario($idUsuario);
if ($cambioExitoso)
    $response = array('title' => 'EXITO', 'message' => 'El usuario ha sido activado correctamente');
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar activar al usuario');
// Convertir el array a formato JSON
echo json_encode($response);
