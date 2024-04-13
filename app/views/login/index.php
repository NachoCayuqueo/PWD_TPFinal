<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Login";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <div class="row vh-100 g-0">
        <!-- left side -->
        <!-- d-none d-lg-block => tamaño chico, se esconde la imagen -->
        <div class="col-lg-6 position-relative d-none d-lg-block">
            <div class="bg-holder login-image"></div>
        </div>
        <!-- right side -->
        <div class="col-lg-6 ">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-6">
                    <!-- logo -->
                    <a href="../home" class="d-flex justify-content-center mb-4">
                        <img src="<?php echo $LOGOS ?>/logo_pet_shop.png" alt="logo" width="150">
                    </a>
                    <div class="text-center mb-5">
                        <h3 class="fw-bold">Iniciar Sesión</h3>
                        <p class="text-secondary">obtener acceso a su cuenta</p>
                    </div>

                    <!-- form -->
                    <form id="formulario-login" name="formulario-login" novalidate>
                        <div class="input-group mb-3 ">
                            <span class="input-group-text"><img src="<?php echo $BOOTSTRAP_ICONS ?>/envelope-fill.svg" alt="lock"></span>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese Email" required>
                            <div class="invalid-feedback">Debe ingresar un email valido</div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><img src="<?php echo $BOOTSTRAP_ICONS ?>/lock-fill.svg" alt="lock"></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contraseña" required minlength="8">
                            <div class="invalid-feedback">La contraseña debe tener como minimo 8 caracteres</div>
                        </div>
                        <div class="mb-3">
                            <input name=send id=send type=submit value="Login" class="btn btn-primary btn-lg w-100">
                        </div>

                        <div class="text-center">
                            <small>¿No tienes una cuenta?</small>
                            <a href="../register" class="btn fw-bold">Registrate</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo $PUBLIC_JS ?>/validations.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/user/loginAjax.js"></script>
    <script src="<?php echo $PRINCIPAL ?>/public/lib/md5.js"></script>
</body>

</html>