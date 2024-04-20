<?php

include_once "../../config/configuration.php";
$session = new Session();
$objetoUsuarioRol = new AbmUsuarioRol();
if ($session->validar()) {
    $usuario = $session->getUsuario();
    $idUsuario = $usuario->getIdUsuario();
    $rol = $objetoUsuarioRol->obtenerRolActivo($idUsuario);
    $nombreRolActivo = $rol->getRoDescripcion();
}

if (!is_null($nombreRolActivo) && $nombreRolActivo !== 'cliente') {
    $locacion = getHomePage($nombreRolActivo);
    header('Location: ' . $VISTAS . "/" . $locacion);
}


$objetoProducto = new AbmProducto();
$productosDestacados = $objetoProducto->obtenerProductosSimilares('favorite');
$productosNuevos = $objetoProducto->obtenerProductosSimilares('new');

$existenProductosDestacados = false;
if ($productosDestacados) {
    $existenProductosDestacados = true;
}
$existenProductosNuevos = false;
if (!empty($productosNuevos)) {
    $existenProductosNuevos = true;
}
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
    <div class="container-fluid m-5">
        <div class="row">
            <div class="col">
                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $IMAGES ?>/nacho.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $IMAGES ?>/pablo.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include_once "./structures/footer.php"; ?>
</body>

</html>