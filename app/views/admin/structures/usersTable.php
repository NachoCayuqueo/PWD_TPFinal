<?php
include_once "collapseUser.php";
include_once "modals.php";

function crearTablaUsuarios($listaUsuario, $objetoUsuario, $rolesDB)
{
    $arregloRoles = [];

    echo '
    <h4 class="mb-4 title text-center">Listado de Usuarios</h4>
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col"></th>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo Electronico</th>
        <th scope="col">Fecha Deshabilitado</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text">
    ';
    foreach ($listaUsuario as $persona) {
        $param = array('idUsuario' => $persona->getIdUsuario());
        $objetoUsuarioRol = $objetoUsuario->darRoles($param);
        $roles = [];
        foreach ($objetoUsuarioRol as $usuarioRol) {
            $objetoRol = $usuarioRol->getObjetoRol();
            if ($objetoRol) {
                $roles[] = $objetoRol->getRoDescripcion();
            }
        }
        $arregloRoles[] = [
            'idUsuario' => $persona->getIdUsuario(),
            'roles' => $roles
        ];
        echo "<tr>";
        echo "<td><a class='btn btn-link' data-bs-toggle='collapse' href='#collapseUsuario" . $persona->getIdUsuario() . "' role='button' aria-expanded='false' aria-controls='collapseUsuario" . $persona->getIdUsuario() . "'>
                    <img id='toggleIcon_" . $persona->getIdUsuario() . "' src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/chevron-compact-right.svg' alt='right'></a>
             </td>";
        echo "<td class='card-title'>" . $persona->getIdUsuario() . "</td>";
        echo "<td>" . $persona->getUsNombre() . "</td>";
        echo "<td>" . $persona->getUsMail() . "</td>";
        echo "<td>" . ($persona->getUsDeshabilitado() ? $persona->getUsDeshabilitado() : 'Usuario activo') . "</td>";
        echo "<td class='text-center'>
                    <a href='#' class='btn btn-outline-primary edit-btn' data-bs-toggle='modal' data-bs-target='#exampleModal_" . $persona->getIdUsuario() . "'  data-user-id='" . $persona->getIdUsuario() . "'>
                        <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/pen.svg' alt='edit'>
                    </a>
                    <a href='#' class='btn" . ($persona->getUsDeshabilitado() ? ' btn-outline-secondary disabled' : ' btn-outline-danger delete-btn') . "' data-bs-toggle='modal' data-bs-target='#modalDelete_" . $persona->getIdUsuario() . "'>
                        <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/trash3.svg' alt='trash'>
                    </a>
                  </td>";
        echo "</tr>";

        // Función que muestra el área de colapso
        mostrarCollapse($persona->getIdUsuario(), $persona->getUsActivo(), $arregloRoles, $rolesDB);
        $modalId = 'exampleModal_' . $persona->getIdUsuario();
        modalEdit($modalId, $persona->getIdUsuario(), $persona->getUsNombre(), $persona->getUsMail());
        $modalId = 'modalDelete_' . $persona->getIdUsuario();
        modalDelete($modalId, $persona->getIdUsuario(), $persona->getUsNombre());
    }
    echo '</tbody>
    </table>';
}

echo '<script src="' . $PUBLIC_JS . '/admin/changeCollapseButton.js"></script>';
echo '<script src="' . $PUBLIC_JS . '/admin/modalAction.js"></script>';
