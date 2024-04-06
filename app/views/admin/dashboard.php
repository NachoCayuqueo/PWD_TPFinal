<?php
include_once '../../../config/configuration.php';

$session = new Session();
$existeSesion = false;
if ($session->validar()) {
    $usuario = $session->getUsuario();
    if (is_null(($usuario))) {
        $nombreUsuario = 'Usuario';
        header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
    } else {
        $nombreUsuario = $usuario->getUsNombre();
        $idUsuarioActivo = $usuario->getIdUsuario();
        $usuarioRoles = $session->getRol();
        //TODO: realizar funcion aparte - ver donde seria mejor, en ABM o en SESSION
        foreach ($usuarioRoles as $usuarioRol) {
            $objetoRol = $usuarioRol->getObjetoRol();
            $descripcionRol = $objetoRol->getRoDescripcion();
            if ($descripcionRol === 'admin') {
                $existeSesion = true;
            }
        }
    }
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}

$objetoUsuario = new AbmUsuario();
$objetoRol = new AbmRol();

$listaUsuario = $objetoUsuario->buscar(null);
$existeUsuario = false;
if (count($listaUsuario) > 0) {
    $existeUsuario = true;
    $rolesDB = $objetoRol->buscar(null);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Admin";
    include_once "../structures/head.php";
    include_once "./structures/usersTable.php";
    ?>
</head>


<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center">Panel Administrador</h1>
    </div>
    <div class="container-sm p-4">
        <?php
        if ($existeUsuario) {
            crearTablaUsuarios($idUsuarioActivo, $listaUsuario, $objetoUsuario, $rolesDB);
        } else {
            echo '
                    <div class="container d-flex justify-content-center">
                        <div class=" card-container d-flex justify-content-center align-items-center">
                            <div class="card text-center mb-3" style="width: 28rem;">
                                <div class="card-header">
                                    <div class="text-end"><a class="btn-close" href="../../index.php" role="button"></a></div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">UPS!</h5>
                                    <p class="card-text">No se encontraron productos cargados en la base de datos</p>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    <img src="../../assets/logo.png" style="height: 30px;" alt="logo-fai">
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        ?>
    </div>

</body>

</html>