<?php
include_once '../../../../config/configuration.php';
$objetoUsuario = new AbmUsuario();
$data = data_submitted();
$response = array();

$idUsuario = $data['idUsuario'];
$passwordActual = $data['passwordActual'];
$passwordNueva = $data['passwordNueva'];

$modificacionExitosa = $objetoUsuario->modificarPassword($data);
if ($modificacionExitosa)
    $response = array('title' => 'EXITO', 'message' => 'La contraseña se  ha cambiado correctamente');
else
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio  un error al intentar guardar la nueva contraseña');

echo json_encode($response);
