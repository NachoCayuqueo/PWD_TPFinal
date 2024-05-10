<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Registro";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <div class="row vh-100 g-0">
        <!-- left side -->
        <div class="col-lg-6 ">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-6">
                    <!-- logo -->
                    <a href="../home" class="d-flex justify-content-center mb-4 " data-bs-tooltip="tooltip" data-bs-placement="bottom" data-bs-title="Volver al Sitio">
                        <img src="<?php echo $LOGOS ?>/logo_pet_shop.png" alt="logo" width="150">
                    </a>

                    <div class="text-center mb-5">
                        <h3 class="fw-bold">Registrarse</h3>
                        <p class="text-secondary">Complete todos los campos</p>
                    </div>

                    <!-- form -->
                    <form id="formulario-registro-usuario" name="formulario-registro-usuario" novalidate>
                        <div class="input-group mb-3 ">
                            <span class="input-group-text"><img src="<?php echo $BOOTSTRAP_ICONS ?>/person-fill.svg" alt="username"></span>
                            <input type="text" class="form-control " id="user" name="user" placeholder="Nombre de usuario" required>
                            <div class="invalid-feedback">Debe ingresar usuario</div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><img src="<?php echo $BOOTSTRAP_ICONS ?>/lock-fill.svg" alt="lock"></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contraseña" required minlength="8">
                            <div class="invalid-feedback">La contraseña debe tener como minimo 8 caracteres</div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><img src="<?php echo $BOOTSTRAP_ICONS ?>/lock-fill.svg" alt="lock"></span>
                            <input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="Repetir contraseña" required minlength="8">
                            <div class="invalid-feedback">Las contraseñas deben coincidir</div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><img src="<?php echo $BOOTSTRAP_ICONS ?>/envelope-fill.svg" alt="lock"></span>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese Email" required>
                            <div class="invalid-feedback">Debe ingresar un email valido</div>
                        </div>
                        <div class="mb-3">
                            <input name=send id=send type=submit value="Register" class="btn btn-primary btn-lg w-100">
                        </div>

                        <div class="text-center">
                            <small>¿Quieres iniciar sesión?</small>
                            <a href="../login" class="btn fw-bold">Log In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- right side -->
        <!-- d-none d-lg-block => tamaño chico, se esconde la imagen -->
        <div class="col-lg-6 position-relative d-none d-lg-block">
            <div class="bg-holder register-image"></div>
        </div>
    </div>

    <script src="<?php echo $PUBLIC_JS ?>/validations.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/user/registerAjax.js"></script>
    <script src="<?php echo $PRINCIPAL ?>/public/lib/md5.js"></script>

</body>

</html>