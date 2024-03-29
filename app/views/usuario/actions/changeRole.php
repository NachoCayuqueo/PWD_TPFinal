<?php
include_once '../../../../config/configuration.php';
$objetoUsuarioRol = new AbmUsuarioRol();
$data = data_submitted();
$response = array();

$idUsuario = $data['idUsuario'];
$idRol = $data['idRol'];

$param = ["idUsuario" => $idUsuario];
$usuarioRol = $objetoUsuarioRol->buscar($param);
if (!empty($usuarioRol)) {
    $modificacionExitosa = $objetoUsuarioRol->cambiarDeRol($idUsuario, $idRol);
    if ($modificacionExitosa)
        $response = array('title' => 'EXITO', 'message' => 'Se cambio de rol');
    else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio  un error al intentar cambiar de rol');
} else {
    $response = array('title' => 'ERROR', 'message' => 'Usuario no encontrado');
}

echo json_encode($response);
