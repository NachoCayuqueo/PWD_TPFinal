<?php

function mostrarCollapse($idUsuario, $esActivo, $roles, $rolesDB)
{
    echo '<tr class="collapse" id="collapseUsuario' . $idUsuario . '" data-idusuario="' . $idUsuario . '">
              <td></td>
              <td colspan="3">' . crearTablaRol($idUsuario, $roles, $rolesDB) . '</td> <!-- Las tablas internas comienzan en la columna 2 -->
          </tr>
          <tr class="collapse" id="collapseUsuario' . $idUsuario . '" data-idusuario="' . $idUsuario . '">
              <td></td>
              <td colspan="3">' . crearTablaActivo($idUsuario, $esActivo) . '</td> <!-- Las tablas internas comienzan en la columna 2 -->
          </tr>';
}

function crearTablaRol($idUsuario, $roles, $rolesDB)
{
    foreach ($roles as $rol) {
        if ($idUsuario === $rol['idUsuario']) {
            $rolesUsuario = $rol['roles'];

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
                // con ucfirst la primer letra es mayuscula
                $tablaRoles .= '
                <tr>
                    <th scope="row">' . ($idRol) . '</th>
                    <td>' . ucfirst($descripcionRol) . '</td>
                    <td><input class="form-check-input" type="checkbox" value="' . $descripcionRol . '" id="flexCheckDefault' . ($idRol) . '" data-idrol="' . $idRol . '" ' . $checked . '></td>
                </tr>';
            }

            $tablaRoles .= '
                </tbody>
            </table>';
        }
    }
    return $tablaRoles;
}


function crearTablaActivo($idUsuario, $esActivo)
{
    $checked = $esActivo ? 'checked' : '';
    $mensaje = $esActivo ? "El usuario está activo" : "El usuario no está activo";
    return '
        <table id="statusTable" class="table table-borderless table-status" >
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                        <td id="estadoUsuario_' . $idUsuario . '">' . $mensaje . '</td>
                        <td>
                          <input class="form-check-input checkBoxActiveUser" type="checkbox" value="" id="checkBoxActiveUser_' . $idUsuario . '"' . $checked . '>
                        </td>
                </tr>
            </tbody>
        </table>                  
    ';
}

echo '<script src="' . $PUBLIC_JS . '/admin/updateRoles.js"></script>';
echo '<script src="' . $PUBLIC_JS . '/admin/updateUserStatusAjax.js"></script>';
echo '<script src="' . $PUBLIC_JS . '/admin/observeCheckBoxStatus.js"></script>';
