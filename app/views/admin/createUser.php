<?php
include_once '../../../config/configuration.php';

$session = new Session();
$esUsuarioValido = $session->validarUsuario();

$existenRoles = false;

if ($esUsuarioValido) {
    $objetoRol = new AbmRol();
    $listaRoles = $objetoRol->buscar(null); //obtengo todos los roles

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
    $title = "Panel Admin";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center">Panel Administrador</h1>
    </div>
    <div class="container mt-3 mb-3">
        <div class="card ">
            <div class="card-header text-center">
                <h3 class="title">Nuevo Usuario</h3>
            </div>
            <div>
                <form class="form card-body card-title" id="form-nuevo-usuario" name="form-nuevo-usuario" novalidate>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" name="name" class="form-control" type="text" required>
                            <div class="invalid-feedback">Ingresar Nombre</div>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" class="form-control" type="text" required>
                            <div class="invalid-feedback">Ingresar email valido</div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" name="password" class="form-control" type="text" required minlength="8">
                            <div class="invalid-feedback">La contraseña debe tener como minimo 8 caracteres</div>
                        </div>
                        <div class="col">
                            <label for="repeat-password" class="form-label">Repetir Contraseña</label>
                            <input id="repeat-password" name="repeat-password" class="form-control" type="text" required minlength="8">
                            <div class="invalid-feedback">Las contraseñas deben coincidir</div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="rol" class="form-label">Seleccionar Roles</label>
                            <div>
                                <?php
                                if ($existenRoles) {
                                    foreach ($listaRoles as $rol) {
                                        $idRol = $rol->getIdRol();
                                        $descripionRol = $rol->getRoDescripcion();
                                        echo '
                                            <input type="checkbox" class="btn-check btn-check-roles" id="btn-check-' . $idRol . '" value="' . $descripionRol . '" ' . ($descripionRol === 'cliente' ? "checked" : "") . ' autocomplete="off">
                                            <label class="btn" for="btn-check-' . $idRol . '">' . $descripionRol . '</label>        
                                        ';
                                    }
                                }
                                ?>
                            </div>
                            <div><span id="error-check" class="errorCheck"></span></div>
                        </div>
                        <div class="col">
                            <label for="user" class="form-label">Activar Usuario</label>
                            <div>
                                <input type="radio" class="btn-check" name="options-base" id="option1" autocomplete="off" checked>
                                <label class="btn" for="option1">SI</label>

                                <input type="radio" class="btn-check" name="options-base" id="option2" autocomplete="off">
                                <label class="btn" for="option2">NO</label>

                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                        <button id='btn-send' class="btn btn-text btn-primary me-md-2" type="submit">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            Enviar
                        </button>
                        <button id='btn-clean' class="btn btn-text btn-primary" type="reset">Borrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="<?php echo $PUBLIC_JS ?>/admin/validations.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/admin/createUserAjax.js"></script>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>