<?php
include_once "../../../../config/configuration.php";
$session = new Session();
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (!empty($usuario)) {
        $idUsuario = $usuario->getIdUsuario();
        $nombre = $usuario->getUsNombre();
        $email = $usuario->getUsMail();
    }
}
?>
<div id="container-datos-personales" class="container d-flex justify-content-center">
    <div class="card" style="width: 600px;">
        <div class="card-header text-center">
            <h3 class="title">Datos Personales</h3>
        </div>
        <div>
            <form class="form card-body card-title" id="formulario-datos-personales" name="formulario-datos-personales" novalidate>
                <div class="row mb-4">
                    <div class="col">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" name="name" class="form-control" type="text" value="<?php echo $nombre ?>" data-id="<?php echo $idUsuario ?>" required>
                        <div class="invalid-feedback">Ingresar Nombre</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" class="form-control" type="text" value="<?php echo $email ?>" required>
                        <div class="invalid-feedback">Ingresar email valido</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <button id="btn-send" class="btn btn-text btn-primary me-md-2" type="submit">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo $PUBLIC_JS ?>/user/validatePersonalData.js"></script>
<script src="<?php echo $PUBLIC_JS ?>/user/changePersonalDataAjax.js"></script>