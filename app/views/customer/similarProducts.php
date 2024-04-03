<?php
include_once '../../../config/configuration.php';
$session = new Session();
$esUsuarioValido = $session->validarUsuario("cliente");
$existenProductos = false;
if ($esUsuarioValido) {
    $data = data_submitted();
    $tipoProducto = $data['type'];

    $objetoProducto = new AbmProducto();
    $productosTipoSimilares =  $objetoProducto->obtenerProductosSimilares($tipoProducto);
    $nombreTipo = $objetoProducto->obtenerNombreTipo($tipoProducto);

    if (!empty($productosTipoSimilares)) {
        $existenProductos = true;
    }
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Productos";
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
        <div>
            <div class="title-with-line">
                <h1 class="title text-center"><?php echo $nombreTipo ?></h1>
            </div>
            <div class="main-container">
                <div class="container-sm p-4">
                    <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                        <?php
                        if ($existenProductos) {
                            foreach ($productosTipoSimilares as $producto) {
                                $botonComprar = "../customer/buyProduct.php?idProducto=" . $producto->getIdProducto();
                                echo '<div class="col">';
                                productsCard($producto, $botonComprar);
                                echo '</div>';
                            }
                        } else {
                            echo '
                            <div>
                            <p>Productos no encontrados</p>
                            </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>