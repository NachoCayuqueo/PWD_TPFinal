<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$data = data_submitted();
$response = array();

if (!empty($data)) {
    $email = $data['email'];
    $pass = $data['password'];

    $session = new Session();
    $isActiveSession = $session->activa();

    if ($isActiveSession) {
        $res = $session->iniciar($email, $pass);
        if ($res) {
            $response = $objetoUsuario->esUsuarioActivo($email);
            if ($response)
                $response = array('title' => 'EXITO', 'message' => 'Bienvenido ' . $email);
            else
                $response = array('title' => 'ERROR', 'message' => 'Su cuenta aun no esta activa.');
        } else {
            $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al iniciar sesion');
        }
    } else {
        $response = array('title' => 'ERROR', 'message' => 'Sesion Inactiva');
    }
}

echo json_encode($response);
