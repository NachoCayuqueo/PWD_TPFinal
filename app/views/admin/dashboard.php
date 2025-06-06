<?php
include_once '../../../config/configuration.php';

$session = new Session();
$existeUsuario = false;

$esUsuarioValido = $session->validarUsuario();
if ($esUsuarioValido) {
    $objetoUsuario = new AbmUsuario();
    $objetoRol = new AbmRol();
    $listaUsuario = $objetoUsuario->buscar(null);
    if (count($listaUsuario) > 0) {
        $existeUsuario = true;
        $rolesDB = $objetoRol->buscar(null);
    }
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
    include_once "./structures/usersTable.php";
    ?>
</head>


<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center title">Panel Administrador</h1>
    </div>
    <div class="container-sm p-4">
        <?php
        if ($existeUsuario) {
            echo '
            <div class="text">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Lista Usuarios Activos</button>
                    </li>
                  
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="inactives-user-tab" data-bs-toggle="tab" data-bs-target="#inactives-user-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Lista Usuarios Nuevos</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="disabled-user-tab" data-bs-toggle="tab" data-bs-target="#disabled-user-tab-pane" type="button" role="tab" aria-controls="disabled-user-tab-pane" aria-selected="false">Lista Usuarios Deshabilitados</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">';
            if (crearTablaUsuarios($idUsuarioActivo, $listaUsuario, $objetoUsuario, $rolesDB) === 0) {
                echo "<p>No se encontraron menus activos.</p>";
            }
            echo '</div>
                  <div class="tab-pane fade" id="inactives-user-tab-pane" role="tabpanel" aria-labelledby="inactives-user-tab" tabindex="0">';
            if (crearTablaNuevoUsuarios($listaUsuario) === 0) {
                echo '<p>No se encontraron nuevos usuarios</p>';
            };
            echo '</div>
                  <div class="tab-pane fade" id="disabled-user-tab-pane" role="tabpanel" aria-labelledby="disabled-user-tab" tabindex="0">';
            if (crearTablaUsuariosDeshabilitados($listaUsuario) === 0) {
                echo '<p>No se encontraron nuevos desactivados</p>';
            };
            echo '</div>
                </div>
            </div>
            ';
        } else {
            echo '
                <div class="d-flex justify-content-center">
                    <h4 class="text">No se encontraron usuarios cargados en la base de datos</h4>
                </div>';
        }
        ?>
    </div>
    <?php include_once "../structures/footer.php"; ?>
</body>

</html>