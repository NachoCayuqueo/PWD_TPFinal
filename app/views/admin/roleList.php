<?php
include_once "../../controllers/validaciones.php";
include_once "roleModals.php";

$existenRoles = false;
$objetoRoles = new AbmRol();
$listaRoles = $objetoRoles->buscar(null);
if (!empty($listaRoles)) {
    $existenRoles = true;
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
        <h1 class="title text-center">Panel Administrador</h1>
    </div>
    <div class="container-sm p-4">
        <?php
        if ($listaRoles) {
            crearTablaRoles($listaRoles);
        } else {
            echo '
                <div class="d-flex justify-content-center">
                    <h4 class="text">No se encontraron roles cargados en la base de datos</h4>
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