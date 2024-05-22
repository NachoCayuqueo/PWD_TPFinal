<?php
include_once "../../../config/configuration.php";
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
    $title = "Principal";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    include_once '../structures/cards.php';
    ?>

    <div class="container-fluid banner-color banner-text-color">
        <div class="row py-3">
            <div class="col-md-8">
                <h2 class="welcome-title text-center mt-3">Bienvenidos a</h2>
                <h1 class="welcome-title text-center">Doggys Friends</h1>
                <p class="text mt-3 p-2">¡Bienvenidos a Doggys Friends, tu destino número uno para mimar a tus fieles compañeros de cuatro patas! En Doggys Friends, nos enorgullece ofrecerte
                    una amplia gama de productos diseñados para el bienestar y la felicidad de tus adorables amigos peludos. Desde juguetes irresistibles hasta las últimas
                    tendencias en moda canina, estamos aquí para satisfacer todas las necesidades de tus perros con estilo y calidad. <br />
                    En Doggys Friends, sabemos que cada perro es único, por eso nos esforzamos por ofrecerte una experiencia de compra personalizada y amigable.Nuestro equipo de
                    expertos está aquí para brindarte asesoramiento y recomendaciones para que encuentres los productos perfectos que se adapten a las necesidades y personalidad
                    de tu peludo amigo.
                </p>
            </div>
            <div class="col-md-4">
                <div class="image-container">
                    <img src="<?php echo $IMAGES ?>/welcome1.png" alt="welcome" class="img-fluid" style="width: 600px;">
                </div>
            </div>
        </div>
    </div>
    <!-- populars products  -->
    <div>
        <div class="title-with-line">
            <h1 class="title text-center">Productos Destacados</h1>
        </div>
        <div class="">
            <div class="container-sm p-4">
                <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                    <?php
                    if ($existenProductosDestacados) {
                        // Obtener el total de productos disponibles
                        $numProductos = count($productosDestacados);

                        // Obtener tres números aleatorios únicos
                        $indicesAleatorios = array_rand($productosDestacados, min(3, $numProductos));
                        foreach ($indicesAleatorios as $indice) {
                            $productoDestacado = $productosDestacados[$indice];
                            $botonComprar = "../customer/buyProduct.php?idProducto=" . $productoDestacado->getIdProducto();
                            echo '<div class="col">';
                            productsCard($productoDestacado, $botonComprar);
                            echo '</div>';
                        }
                    } else {
                        echo  "<div class='container text-center'>No hay productos registrados.</div>";
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <!-- new products -->
    <div>
        <div class="title-with-line">
            <h1 class="title text-center">Productos Nuevos</h1>
        </div>
        <div class="">
            <div class="container-sm p-4">
                <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                    <?php
                    if ($existenProductosNuevos) {
                        // Obtener el total de productos disponibles
                        $numProductosNuevos = count($productosNuevos);

                        // Obtener tres números aleatorios únicos
                        $indicesAleatoriosNuevos = array_rand($productosNuevos, min(3, $numProductosNuevos));
                        foreach ($indicesAleatoriosNuevos as $indice) {
                            $productoNuevo = $productosNuevos[$indice];
                            $botonComprar = "../customer/buyProduct.php?idProducto=" . $productoNuevo->getIdProducto();
                            echo '<div class="col">';
                            productsCard($productoNuevo, $botonComprar);
                            echo '</div>';
                        }
                    } else {
                        echo  "<div class='container text-center'>No hay productos registrados.</div>";
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <?php include_once "../structures/footer.php"; ?>
</body>

</html>