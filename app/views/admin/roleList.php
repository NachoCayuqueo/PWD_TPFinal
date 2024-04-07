<?php
include_once '../../../config/configuration.php';
include_once "roleModals.php";

$session = new Session();
$esUsuarioValido = $session->validarUsuario();
$existenRoles = false;
if ($esUsuarioValido) {
    $objetoRoles = new AbmRol();
    $listaRoles = $objetoRoles->buscar(null);
    if (!empty($listaRoles)) {
        $existenRoles = true;
    }
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Roles";
    include_once "../structures/head.php";
    include_once "./structures/roleTable.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center">Panel Administrador</h1>
    </div>
    <div class="container-sm p-4">
        <?php
        if ($listaRoles) {
            crearTablaRoles($listaRoles);
        } else {
            echo '
                    <div class="container d-flex justify-content-center">
                        <div class=" card-container d-flex justify-content-center align-items-center">
                            <div class="card text-center mb-3" style="width: 28rem;">
                                <div class="card-header">
                                    <div class="text-end"><a class="btn-close" href="index.php" role="button"></a></div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">UPS!</h5>
                                    <p class="card-text">No se encontraron roles cargados en la base de datos</p>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    <img src="../../assets/logo.png" style="height: 30px;" alt="logo-fai">
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        ?>
        <!-- Botón para agregar nuevos roles -->
        <div class="btn-floating">
            <a class="btn" data-bs-toggle="modal" data-bs-target="#modalAddRole" type="button" data-bs-tooltip="tooltip" data-bs-placement="top" data-bs-title="Nuevo Rol">
                <img src="<?php echo $BOOTSTRAP_ICONS ?>/plus-circle-fill.svg" alt="add" width="65">
            </a>
        </div>
    </div>

    <?php
    modalAddRole();
    ?>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>