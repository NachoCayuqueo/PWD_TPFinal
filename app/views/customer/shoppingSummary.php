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
    //viewStructure($listaCompra);
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
            echo '
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Compras Realizadas</button>
                    </li>
                  
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Compras Canceladas</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">';
            if (crearTablaResumenCompra($listaCompra) === 0) {
                echo "<p>No se encontraron compras registradas.</p>";
            }
            echo '</div>
                  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">';
            if (!crearTablaComprasCanceladas($listaCompra)) {
                echo "<p>No se encontraron compras canceladas.</p>";
            };
            echo '</div>
                </div>
            </div>
            ';
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