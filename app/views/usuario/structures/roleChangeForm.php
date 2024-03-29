<?php
include_once "../../../../config/configuration.php";
$session = new Session();
$existenRoles = false;
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (is_null(($usuario))) {
        $nombreUsuario = 'Usuario';
        echo 'usuario no encontrado';
    } else {
        $idUsuario = $usuario->getIdUsuario();
        $listaRoles = $session->getRol();
        $existenRoles = true;
    }
}

?>
<div id="container-cambio-rol" class="container d-flex justify-content-center">
    <div class="card" style="width: 600px;">
        <div class="card-header text-center">
            <h3 class="title">Cambiar de Rol</h3>
        </div>
        <div>
            <form class="form card-body card-title" id="formulario-cambio-rol" name="formulario-cambio-rol" data-id="<?php echo $idUsuario ?>" novalidate>
                <div class="row mb-4">
                    <div class="col">
                        <label for="rol" class="form-label">Roles Disponibles</label>
                        <div>
                            <?php
                            if ($existenRoles) {
                                foreach ($listaRoles as $rol) {
                                    $objetoRol = $rol->getObjetoRol();
                                    $idRol = $objetoRol->getIdRol();
                                    $descripionRol = $objetoRol->getRoDescripcion();
                                    $esRolActivo = $rol->getRolActivo();
                                    echo '
                                        <input type="radio" class="btn-check" name="options-base" id="option_' . $idRol . '"  ' . ($esRolActivo ? "checked" : "") . ' autocomplete="off" >
                                        <label class="btn" for="option_' . $idRol . '">' . $descripionRol . '</label>
                                    ';
                                }
                            }
                            ?>
                        </div>
                        <div><span id="error-check" class="errorCheck"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <button id="btn-send" class="btn btn-text btn-primary me-md-2" type="submit">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo $PUBLIC_JS ?>/user/changePersonalDataAjax.js"></script>