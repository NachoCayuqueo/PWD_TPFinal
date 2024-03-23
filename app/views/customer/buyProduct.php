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
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}

$data = data_submitted();
$idProducto = $data['idProducto'];

$objetoProducto = new AbmProducto();
$datosProducto = $objetoProducto->obtenerDatosProductos($idProducto);
if (!is_null($datosProducto)) {
    $masInfo = $datosProducto['masInfo'];
    $productosSimilares = $datosProducto['productosSimilares'];
    $datosValoraciones = $datosProducto['datosValoraciones'];
    $valoraciones = $datosValoraciones['valoraciones'];
    $promedioValoraciones = $datosValoraciones['promedio'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Comprar";
    include_once "../structures/head.php";
    include_once "./strucures/modals.php";
    ?>
</head>


<body>
    <?php
    include_once '../structures/navbar.php';
    include_once '../structures/cards.php';
    ?>
    <div class="container p-2">
        <div class="row">
            <div class="col-8">
                <div class="container p-2">
                    <img src="<?php echo $datosProducto['urlImagen'] ?>" alt="<?php echo $datosProducto['nombre'] ?>" class="image img-fluid" width="90%">
                </div>
            </div>
            <div id="product-info" class="col-4" data-id-product="<?php echo $datosProducto['id']; ?>" data-id-user="<?php echo $idUsuarioActivo ?>">
                <div class="mt-3">
                    <h1 class="title text-center"><?php echo $datosProducto['nombre'] ?></h1>
                </div>
                <hr class="my-1" style="border-width: 2px;">

                <div class="rating-container">
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <div class="reviews text">
                        <input type="hidden" id="promedio" value="<?php echo $promedioValoraciones ?>">
                        <a href="#" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalReviews">
                            <?php echo ($datosValoraciones['cantidadValoraciones'] > 0 ? $datosValoraciones['cantidadValoraciones'] : '0') ?> reviews
                        </a>
                        <?php modalReviews($valoraciones) ?>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 class="text"><?php echo $datosProducto['descripcion'] ?></h5>
                    <?php
                    foreach ($masInfo as $info) {
                        echo '<p class="ms-3 text"> - ' . $info . '</p>';
                    }
                    ?>
                </div>
                <div class="mt-4">
                    <h3 class="title"><?php echo "$ " . $datosProducto['precio'] ?></h3>
                </div>
                <div class="mt-3">
                    <p><?php
                        echo $datosProducto['stock'] <= 1 ? 'Apresurate, es el ultimo!' : '';
                        ?></p>
                    <div class="d-flex">
                        <div class="input-group mb-3" style="width: 150px;">
                            <button class="btn btn-outline-secondary" type="button" id="button-minus">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/dash.svg" alt="minus">
                            </button>
                            <input type="number" class="form-control text-center" placeholder="1" id="quantity" value="1">
                            <button class="btn btn-outline-secondary" type="button" id="button-plus">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/plus.svg" alt="plus">
                            </button>
                        </div>
                        <div class="ms-2 btn-text">
                            <button class="btn btn-primary" id="btn-cart">AGREGAR AL CARRITO</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-4">
            <div class="title-with-line">
                <h1 class="title">Productos Similares</h1>
            </div>
            <div class="main-container">
                <div class="container-sm p-4">
                    <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                        <?php
                        // Obtener el total de productos disponibles
                        $numProductos = count($productosSimilares);

                        // Obtener tres números aleatorios únicos
                        $indicesAleatorios = array_rand($productosSimilares, min(3, $numProductos));

                        // Mostrar los productos correspondientes a los índices aleatorios
                        foreach ($indicesAleatorios as $indice) {
                            $objetoProducto = $productosSimilares[$indice];

                            $botonComprar = "buyProduct.php?idProducto=" . $objetoProducto->getIdProducto();
                            echo '<div class="col">';
                            productsCard($objetoProducto, $botonComprar);
                            echo '</div>';
                        }

                        ?>

                    </div>
                </div>
            </div>
            <div class="text-center"><button class="btn btn-outline-primary">Mas Productos similares</button></div>
        </div>
    </div>

    <script src="<?php echo $PUBLIC_JS ?>/customer/ranking.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/handleQuantityButtonClick.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/buttonModal.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/cartAjax.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>