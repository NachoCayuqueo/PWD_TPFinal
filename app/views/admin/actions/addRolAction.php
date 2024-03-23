<?php
include_once '../../../../config/configuration.php';
//! verificar que el nombre no existe en la DB
$objetoRol = new AbmRol();
$response = array();

$data = data_submitted();

$nombreRol = $data['nombreRol'];
$param = ['roDescripcion' => $nombreRol];

$listaRoles = $objetoRol->buscar(null);
$existeRol = false;
if (!empty($listaRoles)) {
    foreach ($listaRoles as $rol) {
        $descripcionRol = $rol->getRoDescripcion();
        if (strtolower($nombreRol) === strtolower($descripcionRol)) {
            //si se encuentra un rol con ese mismo nombre, enviamos mensaje de error 
            $response = array('title' => 'ERROR', 'message' => 'El rol que intenta cargar ya existe');
            $existeRol = true;
            break;
        }
    }
}

if (!$existeRol) {
    $altaExitosa = $objetoRol->alta($param);
    if ($altaExitosa) {
        $response = array('title' => 'EXITO', 'message' => 'Alta exitosa');
    } else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar  dar de alta al usuario');
}


echo json_encode($response);
