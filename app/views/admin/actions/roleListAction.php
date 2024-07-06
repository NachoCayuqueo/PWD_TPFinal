<?php
include_once '../../../../config/configuration.php';
// include_once "../../controllers/validaciones.php";
// include_once "roleModals.php";

$existenRoles = false;
$objetoRoles = new AbmRol();
$listaRoles = $objetoRoles->buscar(null);
$listaRoles = $objetoRoles->toArray($listaRoles);
// viewStructure($listaRoles);

if (!empty($listaRoles)) {
    $response = array('title' => 'EXITO', 'message' => 'El menu tiene roles', 'listaRoles' => $listaRoles);
} else {
    $response = array('title' => 'ERROR', 'message' => 'No existen roles', 'listaRoles' => []);
}
//viewStructure($response); salen bien los datos
echo json_encode($response);
