<?php
include_once '../../../config/configuration.php';
$session = new Session();
$existeSesion = false;
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (is_null(($usuario))) {
        $nombreUsuario = 'Usuario';
        header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
    } else {
        $nombreUsuario = $usuario->getUsNombre();
        $idUsuarioActivo = $usuario->getIdUsuario();
        $usuarioRoles = $session->getRol();
        //TODO: realizar funcion aparte - ver donde seria mejor, en ABM o en SESSION
        foreach ($usuarioRoles as $usuarioRol) {
            $objetoRol = $usuarioRol->getObjetoRol();
            $descripcionRol = $objetoRol->getRoDescripcion();
            if ($descripcionRol === 'cliente') {
                $existeSesion = true;
            }
        }
    }
    $objetoCompra = new AbmCompra();
    $param = ['idUsuario' => $idUsuarioActivo];
    $listaCompra = $objetoCompra->obtenerCompras($param);
    $existeListaCompra = true;
    if (empty($listaCompra)) {
        $existeListaCompra = false;
    }
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Usuario";
    include_once "../structures/head.php";
    include_once "./strucures/summaryTable.php";
    ?>
</head>


<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center">Mis Compras</h1>
    </div>
    <div class="container-sm p-4">
        <?php
        if ($existeListaCompra) {
            crearTablaResumenCompra($listaCompra);
        } else {
            echo '
                    <div class="container d-flex justify-content-center">
                        <p class="card-text">Aun no has realizado ninguna compra en nuestra tienda</p>
                    </div>';
        }
        ?>
    </div>

</body>

</html>