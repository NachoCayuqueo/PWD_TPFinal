<?php
include_once "../../controllers/validaciones.php";

// $objetoCompra = new AbmCompra();
// $compras = $objetoCompra->obtenerDetallesCompras();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Admin";
    include_once "../structures/head.php";
    include_once "./structures/shoppingTable.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="title text-center">Panel Administrador</h1>
    </div>
    <div class="container-sm p-4" id="manageShopping">
    </div>

    <script src="<?php echo $PUBLIC_JS ?>/admin/manageShoppingAjax.js"></script>


    <?php include_once "../structures/footer.php"; ?>
</body>

</html>