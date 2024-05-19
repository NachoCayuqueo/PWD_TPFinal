<?php
include_once '../../../../config/configuration.php';

$objetoUsuarioRol = new AbmUsuarioRol();
$data = data_submitted();

$idUsuario = $data['idUsuario'];
$idRol = $data['idRol'];
$descripcionRol = $data['descripcionRol'];
$isChecked = filter_var($data['isChecked'], FILTER_VALIDATE_BOOLEAN); //me aseguro que sea boolean y no una cadena


$params = [
    "idUsuario" => $idUsuario,
    "idRol" => $idRol,
    "rolActivo" => $isChecked,
];

$response = array();

if ($isChecked) {
    //TODO: dar alta en UsuarioRol
    $altaExitosa = $objetoUsuarioRol->alta($params);
    if ($altaExitosa)
        $response = array('title' => 'EXITO', 'message' => 'Se activo el rol: '  . strtoupper($descripcionRol));
    else
        $response = array('title' => 'ERROR', 'message' => 'ERROR al activar el rol: ' . strtoupper($descripcionRol));
} else {
    //TODO: eliminar en UsuarioRol
    $bajaExitosa = $objetoUsuarioRol->baja($params);
    if ($bajaExitosa)
        $response = array('title' => 'EXITO', 'message' => 'Se dio de baja el rol: ' . strtoupper($descripcionRol));
    else
        $response = array('title' => 'ERROR', 'message' => 'ERROR al dar de baja el rol: ' . strtoupper($descripcionRol));
}

// Convertir el array a formato JSON
echo json_encode($response);
