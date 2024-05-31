<?php
include_once "../../../../config/configuration.php";
$session = new Session();
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (!empty($usuario)) {
        $idUsuario = $usuario->getIdUsuario();
    }
}
?>
<div id="container-cambio-password" class="container d-flex justify-content-center">
    <div class="card" style="width: 600px;">
        <div class="card-header text-center">
            <h3 class="title">Cambiar Contraseña</h3>
        </div>
        <div>
            <form class="form card-body card-title" id="formulario-cambio-password" name="formulario-cambio-password" data-id="<?php echo $idUsuario ?>" novalidate>
                <div class="row mb-4">
                    <div class="col text">
                        <label for="password" class="form-label">Contraseña Actual</label>
                        <input id="password" name="password" class="form-control" type="text" required minlength="8">
                        <div class="invalid-feedback">La contraseña debe tener como minimo 8 caracteres</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col text">
                        <label for="new-password" class="form-label">Contraseña Nueva</label>
                        <input id="new-password" name="new-password" class="form-control" type="text" required minlength="8">
                        <div class="invalid-feedback">Las contraseñas deben coincidir y tener 8 caracteres minimo</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col text">
                        <label for="repeat-password" class="form-label">Repetir Contraseña Nueva</label>
                        <input id="repeat-password" name="repeat-password" class="form-control" type="text" required minlength="8">
                        <div class="invalid-feedback">Las contraseñas deben coincidir y tener 8 caracteres minimo</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <button id="btn-send" class="btn btn-text btn-color me-md-2" type="submit">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo $PUBLIC_JS ?>/user/validatePersonalData.js"></script>
<script src="<?php echo $PUBLIC_JS ?>/user/changePersonalDataAjax.js"></script>