<?php
include_once "../../../config/configuration.php";
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
        <div class="row flex-nowrap">
            <div class="col-auto col-md-4 col-lg-3" style="background-color: #aabebd;">
                <div class="p-2">
                    <a class="d-flex text-decoration-none align-items-center text-white">
                        <span class="fs-4 d-none d-sm-inline">Configuraciones</span>
                    </a>
                    <ul class="nav nav-pills flex-column mt-4">
                        <li class="nav-item">
                            <a id="link-datos-personales" href="#" class="nav-link text-white">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/person-fill.svg" alt="">
                                <span class="fs-5 ms-2 d-none d-sm-inline">Datos Personales</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-cambiar-contrasenia" href="#" class="nav-link text-white">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/lock-fill.svg" alt="">
                                <span class="fs-5 ms-2 d-none d-sm-inline">Contraseña</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-cambiar-roles" href="#" class="nav-link text-white">
                                <img src="<?php echo $BOOTSTRAP_ICONS ?>/card-checklist.svg" alt="">
                                <span class="fs-5 ms-2 d-none d-sm-inline">Roles</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col mb-5 mt-5">
                <div id="contenedor-formulario"></div>
            </div>
        </div>
    </div>
    <?php include_once "../structures/footer.php"; ?>
    <script src="<?php echo $PUBLIC_JS ?>/user/form.js"></script>
</body>

</html>