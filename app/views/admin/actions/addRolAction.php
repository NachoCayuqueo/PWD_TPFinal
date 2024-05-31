<?php
include_once '../../../../config/configuration.php';

$objetoRol = new AbmRol();
$response = array();

$data = data_submitted();

$nombreRol = $data['nombreRol'];

$response = $objetoRol->nuevoRol($nombreRol);

echo json_encode($response);
