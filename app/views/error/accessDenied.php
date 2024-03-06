<?php
include_once '../../../config/configuration.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Acceso Denegado";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <div class="container">
        <h1>Pagina de acceso denegado</h1>
        <p>Pagina en construccion para redireccionar a usuarios que intentan ingresar a una cuenta sin autorizacion</p>
        <a class="btn btn-outline-primary" href="<?php echo $PRINCIPAL ?>/app/views/home">volver</a>

    </div>

</body>

</html>