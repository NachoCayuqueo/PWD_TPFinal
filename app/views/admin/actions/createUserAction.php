<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$response = array();

$data = data_submitted();

$nombre = $data['nombre'];
$email = $data['email'];
$password = $data['password'];
$activarUsuario = $data['activarUsuario'];


//*verificar que el usuario no exista
$param = ["usMail" => $email];
$usuario   = $objetoUsuario->buscar($param);

if (empty($usuario)) {
    $params = [
        'usNombre' => $nombre,
        'usPass' => $password,
        'usMail' => $email,
        'usActivo' => $activarUsuario,
    ];

    $altaExitosa = $objetoUsuario->alta($params);
    if ($altaExitosa) {
        $response = array('title' => 'EXITO', 'message' => 'Alta exitosa');
    } else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar  dar de alta al usuario');
} else {
    $response = ["title" => "ERROR", "message" => "La persona que intenta cargar, ya existe"];
}


// Convertir el array a formato JSON
echo json_encode($response);
