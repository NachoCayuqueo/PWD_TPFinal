<?php
include_once "../../../config/configuration.php";
// $session = new Session();
// if ($session->validar()) {
//     // echo "ID usuario: " . $_SESSION['idusuario'];
//     // header('Location: ' . $PRINCIPAL . "/views/tp5_views/paginaSegura.php");
// }
$productos = new AbmProducto();
$listaProductos = $productos->buscar(null);
$existenProductos = false;
if (count($listaProductos) > 0) {
    $existenProductos = true;
} else {
    echo  "<div class='container'>No hay productos registrados.</div>";
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

    <div class="container-fluid" style="background-color: #dec9ce;">

        <div class="row">
            <div class="col-md-6 text-center">
                <h3 class="mt-3">Bienvenidos a</h3>
                <h1>Doggys Friends</h1>
                <p>Cillum Lorem cillum nostrud ea cupidatat culpa ea non pariatur culpa exercitation enim. Ex reprehenderit excepteur est reprehenderit nisi ipsum velit nostrud. Excepteur minim nisi in est sit dolore quis nulla laborum in. Id amet eiusmod aliqua id. Aliquip do laboris nostrud Lorem. Amet ipsum ullamco sunt cupidatat cillum amet laborum aliquip. Esse Lorem anim nostrud Lorem consectetur adipisicing dolore duis mollit laborum velit.
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
            <h1 class="text-center">Productos Destacados</h1>
        </div>
        <div class="main-container">
            <div class="container-sm p-4">
                <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                    <?php
                    if ($existenProductos) {
                        foreach ($listaProductos as $producto) {
                            if ($producto->getEsProPopular()) {
                                $cardId = $producto->getIdProducto();
                                $detallesJSON = json_decode($producto->getProDetalle(), true);

                                $tipoProducto = $detallesJSON['tipo'];
                                if ($tipoProducto === 'accesorio')
                                    $urlImage =  $IMAGES . "/products/accessories/" . $detallesJSON['imagen'];
                                if ($tipoProducto === 'juguete')
                                    $urlImage =  $IMAGES . "/products/toys/" . $detallesJSON['imagen'];
                                if ($tipoProducto === 'alimento')
                                    $urlImage =  $IMAGES . "/products/food/" . $detallesJSON['imagen'];

                                $descripcion = $detallesJSON['descripcion'];

                                $masInfo = $detallesJSON['masInfo'];
                                echo '<div class="col">';
                                productsCard($cardId, $urlImage, $producto->getProNombre(), $descripcion, $masInfo, $producto->getProPrecio(), "#", "#");
                                echo '</div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <!-- new products -->
    <div>
        <div class="title-with-line">
            <h1 class="text-center">Productos Nuevos</h1>
        </div>
        <div class="main-container">
            <div class="container-sm p-4">
                <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                    <?php
                    if ($existenProductos) {
                        foreach ($listaProductos as $producto) {
                            if ($producto->getEsProNuevo()) {
                                $cardId = $producto->getIdProducto();
                                $detallesJSON = json_decode($producto->getProDetalle(), true);

                                $tipoProducto = $detallesJSON['tipo'];
                                if ($tipoProducto === 'accesorio')
                                    $urlImage =  $IMAGES . "/products/accessories/" . $detallesJSON['imagen'];
                                if ($tipoProducto === 'juguete')
                                    $urlImage =  $IMAGES . "/products/toys/" . $detallesJSON['imagen'];
                                if ($tipoProducto === 'alimento')
                                    $urlImage =  $IMAGES . "/products/food/" . $detallesJSON['imagen'];

                                $descripcion = $detallesJSON['descripcion'];

                                $masInfo = $detallesJSON['masInfo'];
                                echo '<div class="col">';
                                productsCard($cardId, $urlImage, $producto->getProNombre(), $descripcion, $masInfo, $producto->getProPrecio(), "#", "#");
                                echo '</div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <?php include_once "../structures/footer.php"; ?>
</body>



</html>