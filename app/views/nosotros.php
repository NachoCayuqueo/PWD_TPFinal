<?php
include_once "../../config/configuration.php";

$session = new Session();
$objetoUsuarioRol = new AbmUsuarioRol();
if ($session->validar()) {
    $usuario = $session->getUsuario();
    $idUsuario = $usuario->getIdUsuario();
    $rol = $objetoUsuarioRol->obtenerRolActivo($idUsuario);
    $nombreRolActivo = $rol->getRoDescripcion();
}

if (!is_null($nombreRolActivo) && $nombreRolActivo !== 'cliente') {
    $locacion = getHomePage($nombreRolActivo);
    header('Location: ' . $VISTAS . "/" . $locacion);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Quienes Somos";
    include_once "./structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once './structures/navbar.php';
    ?>
    <div class="container-fluid p-5">
        <div>
            <h3 class="text-center">Conoce a los Creadores de Doggy Friends</h3>
        </div>
        <div class="mt-3 mb-4">
            <h5 class="text-center text-body-secondary">Detrás de la Tienda Online Especializada en Productos para Perros</h5>
        </div>

        <div class="row row-cols-1 row-cols-md-2 p-4 mb-4 row-gap-4">
            <div class="col">
                <div class="card h-100 p-2 shadow border border-0">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="<?php echo $IMAGES ?>/staff/nacho.jpg" class="img-fluid rounded-start" alt="nacho">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">¡Hola, soy Nacho!</h5>
                                <p class="card-text">Soy uno de los creadores de Doggy Friends, la tienda online que nació de nuestra pasión por los perros. Además de mi amor por la programación, disfruto explorando nuevos lenguajes y tecnologías para mejorar la experiencia de nuestros clientes peludos. Cuando no estoy trabajando en el sitio web, me encanta desconectar y pasar tiempo de calidad con mi fiel compañero de cuatro patas. ¡Ven y únete a nuestra comunidad perruna!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-2 shadow border border-0">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="<?php echo $IMAGES ?>/staff/pablo.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">¡Hola, soy Pablo!</h5>
                                <p class="card-text">Como uno de los cofundadores de Doggy Friends, me enorgullece brindar a nuestros clientes peludos los mejores productos y experiencias. Amante de los perros y experto en hacerles cosquillas, estoy comprometido con el bienestar y la felicidad de nuestros amigos de cuatro patas. ¡Únete a nuestra manada y descubre todo lo que Doggy Friends tiene para ofrecer!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include_once "./structures/footer.php"; ?>
</body>

</html>


<!-- <div class="row">
            <div class="col">
                <div class="card mb-3" style="height: 300px;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="<?php echo $IMAGES ?>/staff/nacho.jpg" class="img-fluid rounded-start" alt="nacho" style="height: 250px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">¡Hola, soy Nacho!</h5>
                                <p class="card-text">Soy uno de los creadores de Doggy Friends, la tienda online que nació de nuestra pasión por los perros. Además de mi amor por la programación, disfruto explorando nuevos lenguajes y tecnologías para mejorar la experiencia de nuestros clientes peludos. Cuando no estoy trabajando en el sitio web, me encanta desconectar y pasar tiempo de calidad con mi fiel compañero de cuatro patas. ¡Ven y únete a nuestra comunidad perruna!</p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3" style="height: 300px;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="<?php echo $IMAGES ?>/staff/pablo.png" class="img-fluid rounded-start" alt="pablo" style="height: 250px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">¡Hola, soy Pablo!</h5>
                                <p class="card-text">Como uno de los cofundadores de Doggy Friends, me enorgullece brindar a nuestros clientes peludos los mejores productos y experiencias. Amante de los perros y experto en hacerles cosquillas, estoy comprometido con el bienestar y la felicidad de nuestros amigos de cuatro patas. ¡Únete a nuestra manada y descubre todo lo que Doggy Friends tiene para ofrecer!</p>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->