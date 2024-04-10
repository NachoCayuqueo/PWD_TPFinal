<?php
include_once '../../../../config/configuration.php';

$objetoMenu = new AbmMenu();
$response = array();
$data = data_submitted();

$idMenu = $data['idMenu'];

$cambioExitoso = $objetoMenu->activarItemMenu($idMenu);
if ($cambioExitoso)
    $response = array('title' => 'EXITO', 'message' => 'El menu ha sido activado correctamente');
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar activar el menu');
// Convertir el array a formato JSON
echo json_encode($response);
