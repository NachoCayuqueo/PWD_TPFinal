<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$data = data_submitted();

$idUsuario = $data['idUsuario'];
$nombre = $data['nombre'];
$email = $data['email'];

$param = ["idUsuario" => $idUsuario];
$usuario   = $objetoUsuario->buscar($param);

$response = array();

$response = $objetoUsuario->cambiarEmail($idUsuario, $nombre, $email);

// Convertir el array a formato JSON
echo json_encode($response);
