<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$response = array();
$data = data_submitted();

$idUsuario = $data['idUsuario'];

$cambioExitoso = $objetoUsuario->habilitarUsuario($idUsuario);
if ($cambioExitoso) {
    $paramUsuario = ['idUsuario' => $idUsuario];
    $usuario = $objetoUsuario->buscar($paramUsuario);
    $param = [
        "nombreDestinatario" => $usuario[0]->getUsNombre(),
        "emailDestinatario" => $usuario[0]->getUsMail(),
        "asunto" => "habilitarUsuario",
    ];
    $response = phpMailer($param);
} else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar habilitar al usuario');
// Convertir el array a formato JSON
echo json_encode($response);
