<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$objetoUsuarioRol = new AbmUsuarioRol();

$data = data_submitted();

$idUsuario = $data['idUsuario'];

$param = ["idUsuario" => $idUsuario];

$response = array();

//* se verifica si existen roles asociados al usuario
$listaUsuarioRol = $objetoUsuarioRol->buscar($param);
if (!empty($listaUsuarioRol)) {
    foreach ($listaUsuarioRol as $usuarioRol) {
        $objetoRol = $usuarioRol->getObjetoRol();
        $idRol = $objetoRol->getIdRol();
        $params = [
            'idUsuario' => $idUsuario,
            'idRol' =>  $idRol
        ];
        $objetoUsuarioRol->baja($params);
    }
}

$bajaExitosa = $objetoUsuario->deshabilitar($param);
if ($bajaExitosa)
    $response = array('title' => 'EXITO', 'message' => 'Se dio de baja el usuario con el id: ' . $data['idUsuario']);
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al dar de baja el usuario con id: ' . $data['idUsuario']);


// Convertir el array a formato JSON
echo json_encode($response);
