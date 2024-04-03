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

    <div class="container-fluid" style="background-color: #eebbc3;">

        <div class="row">
            <div class="col-md-6">
                <h2 class="title text-center mt-3">Bienvenidos a</h2>
                <h1 class="welcome-title text-center">Doggys Friends</h1>
                <p class="text mt-5 p-2">Cillum Lorem cillum nostrud ea cupidatat culpa ea non pariatur culpa exercitation enim. Ex reprehenderit excepteur est reprehenderit nisi ipsum velit nostrud. Excepteur minim nisi in est sit dolore quis nulla laborum in. Id amet eiusmod aliqua id. Aliquip do laboris nostrud Lorem. Amet ipsum ullamco sunt cupidatat cillum amet laborum aliquip. Esse Lorem anim nostrud Lorem consectetur adipisicing dolore duis mollit laborum velit.
                    Non sint ipsum nisi pariatur nulla nisi id cupidatat dolore officia et qui. Aliquip ipsum excepteur deserunt non eiusmod officia velit velit. Sunt fugiat proident dolor elit pariatur elit fugiat laborum.
                </p>
            </div>
            <div class="col-md-6">
                <div class="image-container">
                    <img src="<?php echo $IMAGES ?>/welcome1.png" alt="welcome" class="img-fluid" style="width: 100%; height: 70vh;">
                </div>
            </div>
        </div>
    </div>
    <!-- populars products  -->
    <div>
        <div class="title-with-line">
            <h1 class="title text-center">Productos Destacados</h1>
        </div>
        <div class="main-container">
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
        <div class="main-container">
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