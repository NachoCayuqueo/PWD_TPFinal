<?php
include_once "../../../config/configuration.php";
// $session = new Session();

// $esUsuarioValido = $session->validarUsuarioPorRol("deposito");
// if ($esUsuarioValido) {
//     $objetoMenu = new AbmMenu();
//     $datosMenu = $objetoMenu->obtenerNombresMenu(2);
// } else {
//     header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Nuevo Panel";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="title text-center">Nuevo Panel</h1>
    </div>
    <div class="container-sm">
        <div class="title d-flex align-items-center justify-content-center mt-3">
            <h1>Esta es una página en construcción</h1>
        </div>
        <div class="text d-flex align-items-center justify-content-center mb-3">
            <img src="<?php echo $IMAGES ?>/working_image.png" width="500px" alt="working">
        </div>
        <div class="text d-flex align-items-center justify-content-center mb-3">
            <h4>¡Perdone las molestias!</h4>
        </div>
    </div>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>