<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$data = data_submitted();

$idUsuario = $data['idUsuario'];
$nombre = $data['nombre'];
$email = $data['email'];
$esConfiguracionPersonal = filter_var($data['esConfiguracionPersonal'], FILTER_VALIDATE_BOOLEAN); //me aseguro que sea boolean y no una cadena

$param = ["idUsuario" => $idUsuario];
$usuario   = $objetoUsuario->buscar($param);

$response = array();

$response = $objetoUsuario->cambiarDatosPersonales($idUsuario, $nombre, $email);
if ($response['title'] === "EXITO" && $response['enviar_email']) {
    $param = [
        "nombreDestinatario" => $nombre,
        "emailDestinatario" => $email,
        "asunto" => "cambioDeEmail",
        "emailAntiguo" => $usuario[0]->getUsMail(),
    ];
    $response = phpMailer($param);
    if ($response['title'] === "EXITO" && $esConfiguracionPersonal) {
        $objetoUsuario->cerrarSesion();
    }
}
// Convertir el array a formato JSON
echo json_encode($response);
