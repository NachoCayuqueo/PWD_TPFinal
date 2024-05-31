<?php

function mostrarCollapse($idUsuario, $fechaDeshabilitado, $esActivo, $roles, $rolesDB)
{
    echo '<tr class="collapse" id="collapseUsuario' . $idUsuario . '" data-idusuario="' . $idUsuario . '">
              <td></td>
              <td colspan="3">' . crearTablaRol($idUsuario, $fechaDeshabilitado, $roles, $rolesDB) . '</td> <!-- Las tablas internas comienzan en la columna 2 -->
          </tr>';
}

function crearTablaRol($idUsuario, $fechaDeshabilitado, $roles, $rolesDB)
{
    foreach ($roles as $rol) {
        if ($idUsuario === $rol['idUsuario']) {
            $rolesUsuario = $rol['roles'];
            $disabled = $fechaDeshabilitado ? "disabled" : "";

            $tablaRoles = '
            <table id="rolesTable" class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Roles</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($rolesDB as $rol) {
                $idRol = $rol->getIdRol();
                $descripcionRol = $rol->getRoDescripcion();
                // Verifica si el rol está presente en los roles del usuario
                $checked = in_array($descripcionRol, $rolesUsuario) ? 'checked' : '';
                $esUnicoRol = count($rolesUsuario) === 1 && $checked;
                $disabled = $esUnicoRol ? "disabled" : ""; // Si el usuario tiene un solo rol, no se puede deshabilitar
                // con ucfirst la primer letra es mayuscula
                $tablaRoles .= '
                <tr>
                    <th scope="row">' . ($idRol) . '</th>
                    <td>' . ucfirst($descripcionRol) . '</td>
                    <td>
                        <input class="form-check-input" type="checkbox" value="' . $descripcionRol . '" id="flexCheckDefault' . ($idRol) . '" data-idrol="' . $idRol . '" ' . $checked . ' ' . $disabled . '>
                    </td>
                </tr>';
            }

            $tablaRoles .= '
                </tbody>
            </table>';
        }
    }
    return $tablaRoles;
}

echo '<script src="' . $PUBLIC_JS . '/admin/updateRolesAjax.js"></script>';
