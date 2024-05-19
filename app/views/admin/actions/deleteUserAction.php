<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$data = data_submitted();

$idUsuario = $data['idUsuario'];

$param = ["idUsuario" => $idUsuario];
$usuario = $objetoUsuario->buscar($param);
$response = array();

$bajaExitosa = $objetoUsuario->deshabilitar($param);
if ($bajaExitosa) {
    $param = [
        "nombreDestinatario" => $usuario[0]->getUsNombre(),
        "emailDestinatario" => $usuario[0]->getUsMail(),
        "asunto" => "bajaUsuario",
    ];
    $response = phpMailer($param);
} else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al dar de baja el usuario con id: ' . $data['idUsuario']);


// Convertir el array a formato JSON
echo json_encode($response);
