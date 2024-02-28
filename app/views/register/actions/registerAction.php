<?php
include_once '../../../../config/configuration.php';

$data = data_submitted();
$objetoPersona = new AbmUsuario();

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
            header('Location: ' . $PRINCIPAL . "/app/views/login");
        } else {
            echo "<div> <h1>ERROR: NO SE DIO DE ALTA A LA PARSONA </h1> </div>";
        }
    }
}
