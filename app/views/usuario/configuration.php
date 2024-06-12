<?php
include_once "../../../config/configuration.php";
$dataJSON = getJSONFileUser();

$session = new Session();
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (!empty($usuario)) {
        $idUsuario = $usuario->getIdUsuario();
        $nombre = $usuario->getUsNombre();
        $email = $usuario->getUsMail();
        $objetoUsuarioRol = new AbmUsuarioRol();
        $rolActivo = $objetoUsuarioRol->obtenerRolActivo($idUsuario)->getRoDescripcion();
        $avatarUsuario = getAvatar($rolActivo);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Configuracion";
    include_once "../structures/head.php";
    include_once "./structures/form.php";
    ?>
</head>


<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="container-fluid">
        <hr class="my-0" style="color: white;">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-4 col-lg-3 navbar-color">
                <div class="p-2">
                    <a class="d-flex text-decoration-none align-items-center text-white">
                        <img src="<?php echo $BOOTSTRAP_ICONS ?>/grid-fill.svg" alt="">
                        <span class="fs-4 d-none d-sm-inline title text-white">Panel</span>
                    </a>
                    <ul class="nav nav-pills flex-column mt-4">
                        <li class="nav-item text">
                            <a id="link-datos-personales" href="#" class="nav-link text-white">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/person-fill.svg" alt="">
                                <span class="fs-5 ms-2 d-none d-sm-inline">Datos Personales</span>
                            </a>
                        </li>
                        <li class="nav-item text">
                            <a id="link-cambiar-contrasenia" href="#" class="nav-link text-white">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/lock-fill.svg" alt="">
                                <span class="fs-5 ms-2 d-none d-sm-inline">Contraseña</span>
                            </a>
                        </li>
                        <li class="nav-item text">
                            <a id="link-cambiar-roles" href="#" class="nav-link text-white">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/card-checklist.svg" alt="">
                                <span class="fs-5 ms-2 d-none d-sm-inline">Roles</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col mb-5 mt-5">
                <div id="contenedor-formulario">
                    <div class="container d-flex justify-content-center">
                        <div class="card mb-3" style="width: 900px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?php echo $BOOTSTRAP_ICONS . "/" . $avatarUsuario  ?>" width="300px" class="img-fluid rounded-start ms-3" alt="avatar">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title title" style="margin-left:25%">Mis Datos</h5>
                                        <div class="mb-2 row text">
                                            <label for="staticName" class="ms-3 col-sm-4 col-form-label">Nombre</label>
                                            <div class="col-sm-6 offset-md-1">
                                                <input type="text" readonly class="form-control-plaintext " id="staticName" value="<?php echo $nombre ?>">
                                            </div>
                                        </div>
                                        <div class="mb-2 row text">
                                            <label for="staticEmail" class="ms-3 col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-6 offset-md-1">
                                                <input type="text" readonly class="form-control-plaintext " id="staticEmail" value="<?php echo $email ?>">
                                            </div>
                                        </div>
                                        <div class="mb-2 row text">
                                            <label for="staticRole" class="ms-3 col-sm-4 col-form-label">Rol Activo</label>
                                            <div class="col-sm-6 offset-md-1">
                                                <input type="text" readonly class="form-control-plaintext " id="staticRole" value="<?php echo $rolActivo ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-0" style="color: white;">
    </div>
    <?php include_once "../structures/footer.php"; ?>
    <script src="<?php echo $PUBLIC_JS ?>/user/form.js"></script>
</body>

</html>