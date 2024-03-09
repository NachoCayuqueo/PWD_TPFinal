<?php
include_once '../../../../config/configuration.php';

$objetoRol = new AbmRol();

$data = data_submitted();
$idRol = $data['idRol'];
$nombreRol = $data['nombreRol'];

$param = ["idRol" => $idRol];
$rol   = $objetoRol->buscar($param);

$response = array();
if (!empty($rol)) {
    $params = [
        "idRol" => $idRol,
        "roDescripcion" => $nombreRol,
    ];
    $modificacionExitosa = $objetoRol->modificacion($params);
    if ($modificacionExitosa)
        $response = array('title' => 'EXITO', 'message' => 'Modificacion exitosa');
    else
        $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al editar el rol con id: ' . $data['idRol']);
} else {
    $response = array('title' => 'ERROR', 'message' => 'Rol no encontrado');
}
// Convertir el array a formato JSON
echo json_encode($response);
