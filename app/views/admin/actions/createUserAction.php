<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$response = array();

$data = data_submitted();

$response = $objetoUsuario->crearUsuario($data);

// Convertir el array a formato JSON
echo json_encode($response);
