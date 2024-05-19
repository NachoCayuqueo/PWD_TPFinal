<?php
include_once "../../../config/configuration.php";
$session = new Session();

$esUsuarioValido = $session->validarUsuarioPorRol("admin");
if ($esUsuarioValido) {
    $objetoMenu = new AbmMenu();
    $datosMenu = $objetoMenu->obtenerNombresMenu(1);
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Admin";
    include_once "../structures/head.php";
    include_once "../structures/cards.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center">Panel Administrador</h1>
    </div>
    <div class="container-sm">
        <div class="row row-cols-1 row-cols-md-3 p-4 mb-4 row-gap-4 text-center">
            <?php
            if (!empty($datosMenu)) {
                foreach ($datosMenu as $menu) {
                    echo '<div class="col">';
                    buttonCard($menu['href'], $menu['nombre']);
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>