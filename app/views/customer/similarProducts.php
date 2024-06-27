<?php
include_once '../../../config/configuration.php';
// $session = new Session();
// $esUsuarioValido = $session->validarUsuario();
// $existenProductos = false;

// if (!$esUsuarioValido && $session->esUsuarioNoLogueado()) {
//     $esUsuarioValido = true;
// }
// if ($esUsuarioValido) {
//     $data = data_submitted();
//     $tipoProducto = $data['type'];

//     $objetoProducto = new AbmProducto();
//     $productosTipoSimilares =  $objetoProducto->obtenerProductosSimilares($tipoProducto);
//     $nombreTipo = $objetoProducto->obtenerNombreTipo($tipoProducto);

//     if (!empty($productosTipoSimilares)) {
//         $existenProductos = true;
//     }
// } else {
//     header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
// }
// 
$data = data_submitted();
$tipoProducto = $data['type'];
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

    <div id="container-similar-products" class="container p-2">

    </div>

    <script>
        const tipoProducto = "<?php echo $tipoProducto; ?>";
        const productInfo = [{
            type: tipoProducto,
            idContainer: "container-similar-products",
            showRandomProducts: false
        }]
    </script>
    <script src="<?php echo $PUBLIC_JS ?>/customer/getProductsAjax.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/moreProductInfo.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>