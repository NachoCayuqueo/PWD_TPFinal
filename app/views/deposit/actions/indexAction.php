<?php

include_once '../../../../config/configuration.php';

$objetoMenu = new AbmMenu();
$datosMenu = $objetoMenu->obtenerNombresMenu(2);

if (!empty($datosMenu)) {
    $response = array('title' => 'EXITO', 'message' => 'Datos del menu', 'datosMenu' => $datosMenu);
} else {
    $response = array('title' => 'ERROR', 'message' => 'El menú no tiene opciones', 'datosMenu' => []);
}
//viewStructure($response); salen bien los datos
echo json_encode($response);
