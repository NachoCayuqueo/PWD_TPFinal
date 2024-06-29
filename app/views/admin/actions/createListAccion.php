<?php
include_once '../../../../config/configuration.php';
$objetoRol = new AbmRol();
$listaRoles = $objetoRol->buscar(null); //obtengo todos los roles

if (!empty($listaRoles)) {
    $listaRoles = $objetoRol->toArray($listaRoles);
    $response = array('title' => 'EXITO', 'listaRol' => $listaRoles);
} else {
    $response = array('title' => 'ERROR', 'listaRol' => []);
}

echo json_encode($response);
