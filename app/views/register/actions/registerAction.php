<?php
include_once '../../../../config/configuration.php';

$data = data_submitted();
$objetoPersona = new AbmUsuario();
$response = array();

$response = $objetoPersona->registrarNuevoUsuario($data);


echo json_encode($response);
