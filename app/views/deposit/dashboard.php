<?php
include_once '../../../config/configuration.php';
include_once './structures/funciones.php';

$session = new Session();
$esUsuarioValido = $session->validarUsuario();
$existeProducto = false;
if ($esUsuarioValido) {
    $objetoProducto = new AbmProducto();
    $objetoRol = new AbmRol();
    $listaProducto = $objetoProducto->buscar(null);
    if (count($listaProducto) > 0) {
        $existeProducto = true;
        $rolesDB = $objetoRol->buscar(null);
    }
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Deposito";
    include_once "../structures/head.php";
    include_once "./structures/usersTable.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center">Panel Deposito</h1>
    </div>
    <div class="container-sm p-4">

        <?php
        if ($existeProducto) {
            crearTablaProducto($listaProducto);
        } else {
            echo '
                    <div class="container d-flex justify-content-center">
                        <div class=" card-container d-flex justify-content-center align-items-center">
                            <div class="card text-center mb-3" style="width: 28rem;">
                                <div class="card-header">
                                    <div class="text-end"><a class="btn-close" href="../../../index.php" role="button"></a></div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">UPS!</h5>
                                    <p class="card-text">No se encontraron productos cargados en la base de datos</p>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    <img src="../../assets/logo.png" style="height: 30px;" alt="logo-fai">
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        ?>
    </div>
    <script src="<?php echo $PUBLIC_JS ?>/deposit/deleteProduct.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>