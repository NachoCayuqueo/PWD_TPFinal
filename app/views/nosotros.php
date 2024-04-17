<?php

include_once "../../config/configuration.php";
// $session = new Session();
// $objetoUsuarioRol = new AbmUsuarioRol();
// if ($session->validar()) {
//     $usuario = $session->getUsuario();
//     $idUsuario = $usuario->getIdUsuario();
//     $rol = $objetoUsuarioRol->obtenerRolActivo($idUsuario);
//     $nombreRolActivo = $rol->getRoDescripcion();
// }

// if (!is_null($nombreRolActivo) && $nombreRolActivo !== 'cliente') {
//     $locacion = getHomePage($nombreRolActivo);
//     header('Location: ' . $VISTAS . "/" . $locacion);
// }


// $objetoProducto = new AbmProducto();
// $productosDestacados = $objetoProducto->obtenerProductosSimilares('favorite');
// $productosNuevos = $objetoProducto->obtenerProductosSimilares('new');

// $existenProductosDestacados = false;
// if ($productosDestacados) {
//     $existenProductosDestacados = true;
// }
// $existenProductosNuevos = false;
// if (!empty($productosNuevos)) {
//     $existenProductosNuevos = true;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Quienes Somos";
    include_once "./structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once './structures/navbar.php';
    include_once './structures/cards.php';
    ?>

    <?php include_once "./structures/footer.php"; ?>
</body>

</html>