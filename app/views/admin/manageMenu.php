<?php
include_once '../../../config/configuration.php';

$session = new Session();
$esUsuarioValido = $session->validarUsuario();
if ($esUsuarioValido) {
    $objetoMenu = new AbmMenu();
    $objetoRol = new AbmRol();
    $misMenus = $objetoMenu->recuperarDatosMenu();
    //* obtener roles de la db
    $roles = $objetoRol->buscar(null);
} else {
    header('Location: ' . $PRINCIPAL . "/app/views/error/accessDenied.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Admin";
    include_once "../structures/head.php";
    include_once "./structures/menuTable.php";
    ?>
</head>


<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="title text-center">Panel Administrador</h1>
    </div>
    <div class="container-sm p-4">
        <?php
        if ($misMenus) {
            echo '
            <div class="text">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Items Activados</button>
                    </li>
                  
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Items Desactivados</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">';
            if (crearTablaMenu($misMenus, $roles) === 0) {

                echo "<p>No se encontraron menus activos.</p>";
            }
            echo '</div>
                  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">';
            if (crearTablaMenuInactivos($misMenus) === 0) {
                echo '<p>No se encontraron menus inactivos</p>';
            };
            echo '</div>
                </div>
            </div>
            ';
        } else {
            echo '
                    <div class="container d-flex justify-content-center">
                        <div class=" card-container d-flex justify-content-center align-items-center">
                            <div class="card text-center mb-3" style="width: 28rem;">
                                <div class="card-header">
                                    <div class="text-end"><a class="btn-close" href="index.php" role="button"></a></div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">UPS!</h5>
                                    <p class="card-text">No se encontraron roles cargados en la base de datos</p>
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

    <?php include_once "../structures/footer.php"; ?>
</body>

</html>