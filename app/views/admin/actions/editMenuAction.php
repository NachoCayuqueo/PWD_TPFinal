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

$param = [
    'idMenu' => $idMenu,
    'nombreItem' => $nombreItem,
    'idRolSeleccionado' => $idRolSeleccionado,
    'deshabilitarSwitch' => $deshabilitarSwitch,
    'subItems' => $subItems
];
$cambioExitoso = $objetoMenu->cambiarItemDelMenu($param);
if ($cambioExitoso)
    $response = array('title' => 'EXITO', 'message' => 'El menu fue editado correctamente');
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el menu');
// Convertir el array a formato JSON
echo json_encode($response);
