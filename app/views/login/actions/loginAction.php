<?php
include_once '../../../../config/configuration.php';

$data = data_submitted();

if (!empty($data)) {
    $user = $data['user'];
    $pass = $data['password'];

    $session = new Session();
    $isActiveSession = $session->activa();

    if ($isActiveSession) {
        $res = $session->iniciar($user, $pass);
        if ($res) {
            header('Location: ' . $PRINCIPAL . "/app/views/home");
        } else {
            echo 'error al iniciar <br>';
            // header('Location: ' . $PRINCIPAL . "/views/tp5_views/login.php");
        }
    } else {
        echo "ERROR:: sesion inactiva";
    }
}
