<?php
//echo "inicio pantalla deposito";
include_once '../../../config/configuration.php';
include_once './structures/funciones.php';
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
            if ($descripcionRol === 'deposito') {
                $existeSesion = true;
            }
        }
    }
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}
$objetoProducto = new AbmProducto();
$objetoRol = new AbmRol();

$listaProducto = $objetoProducto->buscar(null);
$existeProducto = false;

if (count($listaProducto) > 0) {
    $existeProducto = true;
    $rolesDB = $objetoRol->buscar(null);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Deposito";
    include_once "../structures/head.php";
    include_once "./structures/usersTable.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center">Panel Deposito</h1>
    </div>
    <div class="container-sm p-4">

        <?php
        if ($existeProducto) {
            crearTablaProducto($listaProducto);
        } else {
            //si no se encuentra el usuario
            echo '
                    <div class="container d-flex justify-content-center">
                        <div class=" card-container d-flex justify-content-center align-items-center">
                            <div class="card text-center mb-3" style="width: 28rem;">
                                <div class="card-header">
                                    <div class="text-end"><a class="btn-close" href="index.php" role="button"></a></div>
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