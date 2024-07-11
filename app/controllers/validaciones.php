<?php
include_once "../../../config/configuration.php";
include_once "../../app/views/customer/strucures/cartSidePanel.php";
$session = new Session();
$objetoUsuarioRol = new AbmUsuarioRol();

$directorioPadre = dirname($_SERVER['SCRIPT_NAME']);
$ultimoSegmento = basename($directorioPadre);

// echo "script_name: " . $_SERVER['SCRIPT_NAME'], "<br/>";
// echo "dirname: " . $directorioPadre . "<br/>";
// echo "basename: " . $ultimoSegmento . "<br/>";

if ($session->validar()) {
    $usuario = $session->getUsuario();
    $idUsuario = $usuario->getIdUsuario();
    $rol = $objetoUsuarioRol->obtenerRolActivo($idUsuario);
    $nombreRolActivo = $rol->getRoDescripcion();
}

if (!$nombreRolActivo && $ultimoSegmento !== 'home') {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
    exit;
}
if ($nombreRolActivo && $ultimoSegmento !== 'home') {
    //* validacion en base al navbar (condicion necesaria por si se mueve un item)
    $esUsuarioValido = $session->validarUsuario();

    if (!$esUsuarioValido) {
        //* excepcion index (no corresponde a un item del menu)      
        // $esUsuarioValido = $session->validarUsuarioPorRol($ultimoSegmento);
        // if (!$esUsuarioValido) {
        header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
        exit;
        // }
    }
}

//* si no tiene rol, es porque es un usuario sin cuenta, por lo que se muestra el homes
if ($ultimoSegmento === 'home') {
    if (!is_null($nombreRolActivo) && $nombreRolActivo !== 'cliente') {
        $locacion = getHomePage($nombreRolActivo);
        if ($locacion === "")
            $locacion = getHomePage('nuevo');
        header('Location: ' . $VISTAS . "/" . $locacion);
        exit;
    }
}
