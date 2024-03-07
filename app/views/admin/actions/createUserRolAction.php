<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$response = array();

$data = data_submitted();

$email = $data['usuarioMail'];
$idRoles = $data['idRoles'];

$usuarioParam = ['usMail' => $email];
$usuario = $objetoUsuario->buscar($usuarioParam);

if (!empty($usuario)) {
    $idUsuario = $usuario[0]->getIdUsuario();
    foreach ($idRoles as $idRol) {
        $param = [
            'idUsuario' => $idUsuario,
            'idRol' => $idRol
        ];
        $altaExitosa = $objetoUsuario->alta_rol($param);
        if ($altaExitosa) {
            $response = array('title' => 'EXITO', 'message' => 'Alta exitosa');
        } else {
            $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar  dar de alta al usuario-rol');
            break; // Si no se puede agregar el rol
        }
    }
} else {
    $response = ["title" => "ERROR", "message" => "No se encontro al usuario con el correo electronico: " + $email];
}

// Convertir el array a formato JSON
echo json_encode($response);
