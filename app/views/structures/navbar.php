<?php
include_once "../customer/strucures/cartSidePanel.php";
$session = new Session();
$existeSesion = false;
$nombreRolActivo = null;
$idRol = null;
$avatarUsuario = "";
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (is_null(($usuario))) {
        $nombreUsuario = 'Usuario';
    } else {
        $idUsuario = $usuario->getIdUsuario();
        $nombreUsuario = $usuario->getUsNombre();
        // Nombre del usuario que quieres buscar
        $objetoUsuarioRol = new AbmUsuarioRol();
        $idRol = $objetoUsuarioRol->obtenerRolActivo($idUsuario)->getIdRol();

        $nombreRolActivo = $objetoUsuarioRol->obtenerRolActivo($idUsuario)->getRoDescripcion();
        $avatarUsuario = getAvatar($nombreRolActivo);
    }
    $existeSesion = true;
}

if (is_null($nombreRolActivo)) {
    $avatarUsuario = "person-fill.svg";
}

?>

<nav class="navbar navbar-expand-lg" style="background-color: #d4d8f0;">
    <div class="container-fluid">
        <a class="navbar-brand m-2" href="<?php echo $PRINCIPAL ?>" type="button" data-bs-tooltip="tooltip" data-bs-placement="bottom" data-bs-title="Home">
            <img src="<?php echo $LOGOS ?>/logo_pet_shop.png" alt="inicio" width="80" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-title collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-2">
                <li class="nav-item dropdown">
                    <div class="d-flex align-items-center">
                        <p class="m-0 me-2">
                            Bienvenido
                            <?php
                            echo $existeSesion
                                ? $nombreUsuario
                                : "Usuario";
                            ?>
                        </p>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $BOOTSTRAP_ICONS . "/" . $avatarUsuario ?>" alt="inicio" width="30" class="d-inline-block align-text-top">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php
                            if ($existeSesion) {
                                echo '
                                <li><a class="dropdown-item" href="' . $VISTAS . '/usuario/actions/cerrarSesionAction.php">Salir</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="' . $VISTAS . '/usuario/configuration.php">Configuraciones</a></li>';
                            } else {
                                echo '<li><a class="dropdown-item" href="' . $VISTAS . '/login">Login</a></li>
                                <li><a class="dropdown-item" href="' . $VISTAS . '/register">Register</a></li>
                                ';
                            }
                            ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<hr class="my-0" style="color: white;">

<?php
//*menu
$objetoMenu = new AbmMenu();
$objetoMenu->armarMenu($idRol);
?>