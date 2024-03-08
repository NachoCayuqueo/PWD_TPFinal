<?php
include_once '../../../../config/configuration.php';

$objetoRol = new AbmRol();
$objetoUsuarioRol = new AbmUsuarioRol();
$response = array();

$data = data_submitted();

$idRol = $data['idRol'];

//* verifico que no existan usuarios asociados al rol a eliminar
$param = ['idRol' => $idRol];
$listaUsuarioRol = $objetoUsuarioRol->buscar($param);
if (empty($listaUsuarioRol)) {
    // si no hay usuario relacionado con el Rol, procedo a borrarlo
    $bajaExitosa = $objetoRol->baja($param);
    if ($bajaExitosa)
        $response = array('title' => 'EXITO', 'message' => 'Se elimino el rol con el id: ' . $idRol);
    else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al dar de baja el rol con id: ' . $idRol);
} else {
    $response = array('title' => 'ERROR', 'message' => 'Existen usuarios  asignados a este Rol');
}

// Convertir el array a formato JSON
echo json_encode($response);
