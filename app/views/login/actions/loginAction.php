<?php
include_once '../../../../config/configuration.php';

$data = data_submitted();
$response = array();

if (!empty($data)) {
    $user = $data['user'];
    $pass = $data['password'];

    $session = new Session();
    $isActiveSession = $session->activa();

    if ($isActiveSession) {
        $res = $session->iniciar($user, $pass);
        if ($res) {
            $response = array('title' => 'EXITO', 'message' => 'Bienvenido ' . $user);
        } else {
            $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al iniciar sesion');
        }
    } else {
        $response = array('title' => 'ERROR', 'message' => 'Sesion Inactiva');
    }
}

echo json_encode($response);
