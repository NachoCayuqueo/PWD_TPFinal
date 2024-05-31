<?php
include_once '../../../../config/configuration.php';

$objetoRol = new AbmRol();
$objetoUsuarioRol = new AbmUsuarioRol();
$response = array();

$data = data_submitted();

$idRol = $data['idRol'];

$response = $objetoRol->eliminarRol($idRol);

// Convertir el array a formato JSON
echo json_encode($response);
