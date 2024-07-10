<?php
include_once "../../../controllers/validaciones.php";
include_once '../../../config/configuration.php';
$datos = data_submitted();
viewStructure($datos);
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

    <script src="<?php echo $PUBLIC_JS ?>/deposit/editValueAjax.js"></script>
    <script>
        var datos = <?php echo json_encode($datos); ?>;
    </script>

    <div class="mt-3">
        <h1 class="title text-center">Panel Administrador</h1>
    </div>
    <div class="container mt-5">
        <h2>Editar Rol</h2>
        <form id="editRoleForm">
            <div class="form-group">
                <label for="idRol">ID del Rol</label>
                <input type="text" class="form-control" id="idRol" name="idRol" readonly>
            </div>
            <div class="form-group">
                <label for="nombreRol">Nombre del Rol</label>
                <input type="text" class="form-control" id="nombreRol" name="nombreRol">
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
    <script src="<?php echo $PUBLIC_JS ?>/admin/buttonRolAjax.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>