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

$bajaExitoso = $objetoMenu->DeshabilitarItemDelMenu($param);
if ($bajaExitoso)
    $response = array('title' => 'EXITO', 'message' => 'El menu fue deshabilitado correctamente');
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar deshabilitar el menu');

echo json_encode($response);
