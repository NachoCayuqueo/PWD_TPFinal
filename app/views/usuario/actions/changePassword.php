<?php
include_once '../../../../config/configuration.php';
$objetoUsuario = new AbmUsuario();
$data = data_submitted();
$response = array();

$idUsuario = $data['idUsuario'];
$passwordActual = $data['passwordActual'];
$passwordNueva = $data['passwordNueva'];

$param = ["idUsuario" => $idUsuario];
$usuario   = $objetoUsuario->buscar($param);

//TODO: las contraseñas deben compararse codificadas
if (!empty($usuario)) {
    $passwordDB = $usuario[0]->getUsPass();
    if ($passwordDB === $passwordActual) {
        //* Codificar la nueva contraseña
        $modificarParams = [
            "idUsuario" => $idUsuario,
            "usNombre" => $usuario[0]->getUsNombre(),
            "usPass" => $passwordNueva,
            "usMail" => $usuario[0]->getUsMail(),
            "usDeshabilitado" => $usuario[0]->getUsDeshabilitado(),
            "usActivo" => $usuario[0]->getUsActivo() ? '1' : '0'
        ];
        $modificacionExitosa = $objetoUsuario->modificacion($modificarParams);
        if ($modificacionExitosa)
            $response = array('title' => 'EXITO', 'message' => 'La contraseña se  ha cambiado correctamente');
        else
            $response = array('title' => 'ERROR', 'message' => 'Ocurrio  un error al intentar guardar la nueva contraseña');
    } else {
        $response = array('title' => 'ERROR', 'message' => 'La contraseña ingresada es incorrecta');
    }
} else {
    $response = array('title' => 'ERROR', 'message' => 'Usuario no encontrado');
}

echo json_encode($response);
