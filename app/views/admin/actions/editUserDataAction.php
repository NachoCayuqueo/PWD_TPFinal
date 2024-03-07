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

if (!empty($usuario)) {
    if ($nombre === $usuario[0]->getUsNombre() && $email === $usuario[0]->getUsMail()) {
        $response = array('title' => 'SIN CAMBIOS', 'message' => 'No se realizaron cambios en el usuario con id: ' . $data['idUsuario']);
    } else {
        $modificarParams = [
            "idUsuario" => $idUsuario,
            "usNombre" => $nombre,
            "usPass" => $usuario[0]->getUsPass(),
            "usMail" => $email,
            "usDeshabilitado" => $usuario[0]->getUsDeshabilitado(),
            "usActivo" => $isChecked ? '1' : '0'
        ];

        $modificacionExitosa = $objetoUsuario->modificacion($modificarParams);
        if ($modificacionExitosa)
            $response = array('title' => 'EXITO', 'message' => 'Modificacion exitosa con el id: ' . $data['idUsuario']);
        else
            $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el usuario con id: ' . $data['idUsuario']);
    }
} else {
    $response = array('title' => 'NO USUARIO', 'message' => 'Usuario no encontrado');
}

// Convertir el array a formato JSON
echo json_encode($response);
