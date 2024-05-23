<?php
include_once "collapseUser.php";
include_once "modals.php";

function crearTablaUsuarios($idUsuarioAdmin, $listaUsuario, $objetoUsuario, $rolesDB)
{
    $arregloRoles = [];
    $cantidadUsuario = 0;
    echo '
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col"></th>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo Electronico</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text">
    ';
    foreach ($listaUsuario as $persona) {
        $esUsuarioActivo = $persona->getUsActivo();
        $fechaDeshabilitado = $persona->getUsDeshabilitado();
        if ($esUsuarioActivo && !$fechaDeshabilitado) {
            $cantidadUsuario++;
            $param = array('idUsuario' => $persona->getIdUsuario());
            if ($persona->getIdUsuario() !== $idUsuarioAdmin) {
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
                echo "<td class='text-center'>
                    <a href='#' class='btn btn-outline-primary edit-btn' data-bs-toggle='modal' data-bs-target='#exampleModal_" . $persona->getIdUsuario() . "'  data-user-id='" . $persona->getIdUsuario() . "' type='button' data-bs-tooltip='tooltip' data-bs-placement='left' data-bs-title='Editar'>
                        <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/pen.svg' alt='edit'>
                    </a>
                    <a href='#' class='btn" . ($persona->getUsDeshabilitado() ? ' btn-outline-secondary disabled' : ' btn-outline-danger delete-btn') . "' data-bs-toggle='modal' data-bs-target='#modalDelete_" . $persona->getIdUsuario() . "' type='button' data-bs-tooltip='tooltip' data-bs-placement='right' data-bs-title='Borrar'>
                        <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/trash3.svg' alt='trash'>
                    </a>
                  </td>";
                echo "</tr>";

                // Función que muestra el área de colapso
                mostrarCollapse($persona->getIdUsuario(), $persona->getUsDeshabilitado(), $persona->getUsActivo(), $arregloRoles, $rolesDB);
                $modalId = 'exampleModal_' . $persona->getIdUsuario();
                modalEdit($modalId, $persona->getIdUsuario(), $persona->getUsNombre(), $persona->getUsMail());
                $modalId = 'modalDelete_' . $persona->getIdUsuario();
                modalDelete($modalId, $persona->getIdUsuario(), $persona->getUsNombre());
            }
        }
    }
    echo '</tbody>
    </table>';

    return $cantidadUsuario;
}

function crearTablaNuevoUsuarios($listaUsuario)
{
    $cantidadUsuario = 0;
    echo '
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Email</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text">
    ';
    foreach ($listaUsuario as $usuario) {
        $id = $usuario->getIdUsuario();
        $nombre = $usuario->getUsNombre();
        $email = $usuario->getUsMail();
        $esUsuarioActivo = $usuario->getUsActivo();
        $fechaDeshabilitado = $usuario->getUsDeshabilitado();
        if (!$esUsuarioActivo && !$fechaDeshabilitado) {
            $cantidadUsuario++;
            echo "<tr>";
            echo "<td class='card-title'>" . $id . "</td>";
            echo "<td>" . $nombre . "</td>";
            echo "<td>" . $email . "</td>";
            echo "<td class='text-center'>
            <button type='button' class='btn btn-text btn-color' data-bs-toggle='modal' data-bs-target='#modalActivarUsuario_" . $id . "'>
                Activar
            </button>
                </td>";
            echo "</tr>";
            $modalId = 'modalActivarUsuario_' . $id;
            modalActivarUsuario($modalId, $nombre);
        }
    }
    echo '</tbody>
    </table>';
    return $cantidadUsuario;
}

function crearTablaUsuariosDeshabilitados($listaUsuario)
{
    $cantidadUsuario = 0;
    echo '
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Email</th>
        <th scope="col">Fecha Deshabilitado</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text">
    ';
    foreach ($listaUsuario as $usuario) {
        $id = $usuario->getIdUsuario();
        $nombre = $usuario->getUsNombre();
        $email = $usuario->getUsMail();
        $fechaDeshabilitado = $usuario->getUsDeshabilitado();
        if ($fechaDeshabilitado) {
            $fechaDeshabilitado = dateFormat($fechaDeshabilitado);
            $cantidadUsuario++;
            echo "<tr>";
            echo "<td class='card-title'>" . $id . "</td>";
            echo "<td>" . $nombre . "</td>";
            echo "<td>" . $email . "</td>";
            echo "<td>" . $fechaDeshabilitado . "</td>";
            echo "<td class='text-center'>
            <button type='button' class='btn btn-text btn-color' data-bs-toggle='modal' data-bs-target='#modalHabilitarUsuario_" . $id . "'>
                Habilitar
            </button>
                </td>";
            echo "</tr>";
            $modalId = 'modalHabilitarUsuario_' . $id;
            modalHabilitarUsuario($modalId, $nombre);
        }
    }
    echo '</tbody>
    </table>';
    return $cantidadUsuario;
}

echo '<script src="' . $PUBLIC_JS . '/admin/changeCollapseButton.js"></script>';
