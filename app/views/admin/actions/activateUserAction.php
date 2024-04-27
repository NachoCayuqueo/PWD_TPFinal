<?php
include_once '../../../../config/configuration.php';

$objetoUsuario = new AbmUsuario();
$response = array();
$data = data_submitted();

$idUsuario = $data['idUsuario'];
$param = ['idUsuario' => $idUsuario];

$usuario = $objetoUsuario->buscar($param);
$usuario = $usuario[0];
$usuarioMail = $usuario->getUsMail();
$usuarioNombre = $usuario->getUsNombre();


$response = phpMailer($usuarioNombre, $usuarioMail, 'registro');
//$cambioExitoso = $objetoUsuario->activarUsuario($idUsuario);
// //! DENTRO DEL IF HAGO EL LLAMADO A LA FUNCION PARA USAR PHP MAILER
// if ($cambioExitoso) {

//     $response = $notificacionExitosa;
// } else
//     $response = array('title' => 'ERROR', 'message' => 'Ocurrio un error al intentar activar al usuario');
// Convertir el array a formato JSON
echo json_encode($response);
