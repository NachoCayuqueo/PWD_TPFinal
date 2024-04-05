<?php
include_once '../../../../config/configuration.php';

$objetoMenu = new AbmMenu();
$response = array();
$data = data_submitted();

$idMenu = $data['idMenu'];
$nombreItem = $data['nombreItem'];
$idRolSeleccionado = $data['idRolSeleccionado'];
$deshabilitarSwitch = $data['deshabilitarSwitch'];
$subItems = $data['subItems'];

echo $idMenu . " - " . $nombreItem . " - " . $idRolSeleccionado . " - ";
echo "deshabilitarSwitch: " . $deshabilitarSwitch . " - ";
viewStructure($subItems);
// Convertir el array a formato JSON
echo json_encode($response);
