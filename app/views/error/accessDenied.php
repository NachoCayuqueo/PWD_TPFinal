<?php
include_once './config/configuration.php';
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
    <?php include_once "../structures/navbar.php"; ?>
    <div class="container mt-5 mb-5" style="display: flex; justify-content: center; align-items: center;">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card border-danger" style="max-width: 900px; margin: auto;">
                    <h5 class="card-header bg-danger text-white">Acceso Denegado</h5>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div style="max-width: 200px;">
                            <img src="../../../assets/images/AccesoDenegado.jpg" alt="accesoDenegado" style="width: 100%; height: auto;">
                        </div>
                        <div class="ml-3">
                            <p class="text-center">No tiene los permisos necesarios para redireccionarlo a la página que intentó ingresar.</p>
                            <a class="btn btn-outline-danger d-block mx-auto" href="<?php echo $PRINCIPAL ?>/app/views/home">Inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../structures/footer.php"; ?>
</body>


</html>