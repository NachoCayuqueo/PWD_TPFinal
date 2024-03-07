<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$data = data_submitted();

$idUsuario = $data['idUsuario'];
$isChecked = filter_var($data['isChecked'], FILTER_VALIDATE_BOOLEAN); //me aseguro que sea boolean y no una cadena


$param = ["idUsuario" => $idUsuario];
$usuario   = $objetoUsuario->buscar($param);

$response = array();

if (!empty($usuario)) {
    $modificarParams = [
        "idUsuario" => $idUsuario,
        "usNombre" => $usuario[0]->getUsNombre(),
        "usPass" => $usuario[0]->getUsPass(),
        "usMail" => $usuario[0]->getUsMail(),
        "usDeshabilitado" => $usuario[0]->getUsDeshabilitado(),
        "usActivo" => $isChecked ? '1' : '0'
    ];


    $modificacionExitosa = $objetoUsuario->modificacion($modificarParams);
    if ($modificacionExitosa)
        $response = array('message' => 'Modificacion exitosa con el id: ' . $data['idUsuario']);
    else
        $response = array('message' => 'ERROR al modificar el usuario: ' . $data['idUsuario']);
}




// Convertir el array a formato JSON
echo json_encode($response);
