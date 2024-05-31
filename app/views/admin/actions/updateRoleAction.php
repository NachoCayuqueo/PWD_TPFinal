<?php
include_once '../../../../config/configuration.php';

$objetoUsuarioRol = new AbmUsuarioRol();
$data = data_submitted();
$response = array();

$idUsuario = $data['idUsuario'];
$idRol = $data['idRol'];
$descripcionRol = $data['descripcionRol'];
$isChecked = filter_var($data['isChecked'], FILTER_VALIDATE_BOOLEAN); //me aseguro que sea boolean y no una cadena


$param = [
    "idUsuario" => $idUsuario,
    "idRol" => $idRol,
    "rolActivo" => $isChecked,
    "nombreRol" => $descripcionRol
];

$response = $objetoUsuarioRol->modificarRolUsuario($param);

// Convertir el array a formato JSON
echo json_encode($response);
