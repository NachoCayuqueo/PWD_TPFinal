<?php
include_once '../../../../config/configuration.php';

$data = data_submitted();
$objetoPersona = new AbmUsuario();
$response = array();

if (!empty($data)) {
    $usuario = $data['user'];
    $pass = $data['password'];
    $email = $data['email'];

    $buscarPersona = array('usMail' => $email);
    $persona = $objetoPersona->buscar($buscarPersona);

    if (empty($persona)) {
        $darDeAlta = array(
            "usNombre" => $usuario,
            "usPass" => $pass,
            "usMail" => $email
        );
        $cargaExitosa = $objetoPersona->alta($darDeAlta);
        if ($cargaExitosa) {
            $response = array('title' => 'EXITO', 'message' => 'El registro se realizo exitosamente');
        } else {
            $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar registrar al usuario');
        }
    } else {
        $response = array('title' => 'ERROR', 'message' => 'El usuario ya existe');
    }
} else {
    $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al recuperar los datos ingresados');
}

echo json_encode($response);
