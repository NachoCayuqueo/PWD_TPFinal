<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$objetoUsuarioRol = new AbmUsuarioRol();
$response = array();

$data = data_submitted();
$email = $data['usuarioMail'];
$idRoles = $data['idRoles'];
$esUsuarioActivo = $data['activarUsuario'];
$password = $data['password'];

$usuarioParam = ['usMail' => $email];
$usuario = $objetoUsuario->buscar($usuarioParam);

if (!empty($usuario)) {
    $idUsuario = $usuario[0]->getIdUsuario();
    $param = [
        'idUsuario' => $idUsuario,
        'idRolesAsignados' => $idRoles
    ];
    $response = $objetoUsuarioRol->crearUsuarioRol($param);

    if ($response['title'] === 'EXITO' && $esUsuarioActivo) {
        //enviar mail
        $param = [
            "nombreDestinatario" => $nombre,
            "emailDestinatario" => $email,
            "passwordDestinatario" => $password,
            "asunto" => "altaUsuario",
        ];
        $response = phpMailer($param);
    }
} else {
    $response = ["title" => "ERROR", "message" => "No se encontro al usuario con el correo electronico: " + $email];
}

// Convertir el array a formato JSON
echo json_encode($response);
