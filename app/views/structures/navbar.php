<?php
$session = new Session();
$existeSesion = false;
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (is_null(($usuario))) {
        $nombreUsuario = 'Usuario';
    } else
        $nombreUsuario = $usuario->getUsNombre();
    $existeSesion = true;
}
?>

<nav class="navbar navbar-expand-lg" style="background-color: #d4d8f0;">
    <div class="container-fluid">
        <a class="navbar-brand m-2" href="<?php echo $PRINCIPAL ?>" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Home">
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
                            <img src="<?php echo $BOOTSTRAP_ICONS ?>/person-circle.svg" alt="inicio" width="30" class="d-inline-block align-text-top">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php
                            if ($existeSesion) {
                                echo '
                                <li><a class="dropdown-item" href="' . $VISTAS . '/usuario/actions/cerrarSesionAction.php">Salir</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Configuraciones</a></li>';
                            } else {
                                echo '<li><a class="dropdown-item" href="' . $VISTAS . '/login">Login</a></li>
                                <li><a class="dropdown-item" href="' . $VISTAS . '/register">Register</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Configuraciones</a></li>';
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

<!-- menu dinamico -->
<!-- menu admin -->
<!-- <nav class="navbar navbar-expand-lg" style="background-color: #aabebd;">
    <div class="container-fluid">
        <div class="navbar-title collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-reference="parent" aria-expanded="false" style="color: #f5f7f8;">Usuarios</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Crear Usuarios</a></li>
                        <li><a class="dropdown-item" href="#">Mostrar Usuarias</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-reference="parent" aria-expanded="false" style="color: #f5f7f8;">Roles</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Crear Roles</a></li>
                        <li><a class="dropdown-item" href="#">Mostrar Roles</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> -->

<!-- menu cliente -->
<?php
include_once "../customer/strucures/cartSidePanel.php";
?>

<nav class="navbar navbar-expand-lg" style="background-color: #d4d8f0;">
    <div class="container-fluid">
        <div class="navbar-title collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-reference="parent" aria-expanded="false" style="color: #f5f7f8;">Productos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Accesorios</a></li>
                        <li><a class="dropdown-item" href="#">Juguetes</a></li>
                        <li><a class="dropdown-item" href="#">Comida</a></li>
                    </ul>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link" href="#">Productos Favoritos</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link" href="#">Productos Nuevos</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link" href="<?php echo $VISTAS ?>/customer/shoppingSummary.php">Mis Compras</a>
                </li>
                <li class="nav-item ms-3">
                    <a id="carritoLink" class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Carrito</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg" style="background-color: #aabebd;">
    <div class="container-fluid">
        <div class="navbar-title collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item ms-5">
                    <a href="#" class="nav-link" style="color: #f5f7f8;">Listar Productos</a>
                </li>
                <li class="nav-item ms-5">
                    <a href="#" class="nav-link" style="color: #f5f7f8;">Crear Producto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>