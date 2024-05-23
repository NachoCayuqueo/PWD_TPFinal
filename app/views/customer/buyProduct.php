<?php
include_once '../../../config/configuration.php';
$session = new Session();
$esUsuarioValido = $session->validarUsuarioPorRol("cliente");
$existeListaCompra = false;

if ($esUsuarioValido) {
    $data = data_submitted();
    $idProducto = $data['idProducto'];

    $objetoProducto = new AbmProducto();
    $datosProducto = $objetoProducto->obtenerDatosProductos($idProducto);
    $tipoProductosSimilares = '';
    if (!is_null($datosProducto)) {
        $masInfo = $datosProducto['masInfo'];
        $productosSimilares = $datosProducto['productosSimilares'];
        $datosValoraciones = $datosProducto['datosValoraciones'];
        $valoraciones = $datosValoraciones['valoraciones'];
        $promedioValoraciones = $datosValoraciones['promedio'];
    }
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
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
                <hr class="my-1" style="border-width: 2px; color: #2d3f50;">

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
                            <button class="btn btn-outline-secondary border-color-custom <?php echo $datosProducto['stock'] === 1 ? "disabled" : "" ?>" type="button" id="button-minus">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/dash.svg" alt="minus">
                            </button>
                            <input type="number" class="form-control text-center border-color-custom" placeholder="1" id="quantity" value="1" readonly>
                            <button class="btn btn-outline-secondary border-color-custom <?php echo $datosProducto['stock'] === 1 ? "disabled" : "" ?>" type="button" id="button-plus">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/plus.svg" alt="plus">
                            </button>
                        </div>
                        <div class="ms-2 btn-text">
                            <button class="btn btn-color" id="btn-cart">AGREGAR AL CARRITO</button>
                        </div>
                    </div>
                    <p id="stock" data-cantStock="<?php echo  $datosProducto['stock'] ?>"> cantidad disponible: <?php echo $datosProducto['stock'] ?>/<?php echo $datosProducto['stock'] ?></p>
                </div>
            </div>
        </div>
        <div class="container mb-4">
            <div class="title-with-line">
                <h1 class="title">Productos Similares</h1>
            </div>
            <div>
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
                            $tipoProductosSimilares = $objetoProducto->getProTipo();
                            $botonComprar = "buyProduct.php?idProducto=" . $objetoProducto->getIdProducto();
                            echo '<div class="col">';
                            productsCard($objetoProducto, $botonComprar);
                            echo '</div>';
                        }

                        ?>

                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="similarProducts.php?type=<?php echo $tipoProductosSimilares ?>" class="btn btn-text btn-color">Mas Productos similares</a>
            </div>
        </div>
    </div>

    <script src="<?php echo $PUBLIC_JS ?>/customer/ranking.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/handleQuantityButtonClick.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/buttonModal.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/cartAjax.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>