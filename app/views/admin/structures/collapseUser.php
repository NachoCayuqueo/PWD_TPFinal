<?php

function mostrarCollapse($idUsuario, $esActivo, $roles, $rolesDB)
{
    echo '<tr class="collapse" id="collapseUsuario' . $idUsuario . '" data-idusuario="' . $idUsuario . '">
              <td></td>
              <td colspan="3">' . crearTablaRol($idUsuario, $roles, $rolesDB) . '</td> <!-- Las tablas internas comienzan en la columna 2 -->
          </tr>
          <tr class="collapse" id="collapseUsuario' . $idUsuario . '">
              <td></td>
              <td colspan="3">' . crearTablaActivo($esActivo) . '</td> <!-- Las tablas internas comienzan en la columna 2 -->
          </tr>';
}

function crearTablaRol($idUsuario, $roles, $rolesDB)
{
    // Array de roles predefinidos
    // viewStructure($rolesDB[0]->getRoDescripcion());
    $rolesPredefinidos = ['admin', 'deposito', 'cliente'];

    foreach ($roles as $rol) {
        if ($idUsuario === $rol['idUsuario']) {
            $rolesUsuario = $rol['roles'];
            // viewStructure($rolesUsuario[0]['descripcionRol']);
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
                    <td><input class="form-check-input" type="checkbox" value="' . $descripcionRol . '" id="flexCheckDefault' . ($idRol) . '" ' . $checked . '></td>
                </tr>';
            }

            $tablaRoles .= '
                </tbody>
            </table>';
        }
    }
    return $tablaRoles;
}


function crearTablaActivo($esActivo)
{
    $checked = $esActivo ? 'checked' : '';

    return '
        <table class="table table-borderless" >
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
                  <td>El usuario esta activo</td>
                  <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"' . $checked . '></td>
                </tr>
            </tbody>
        </table>                  
    ';
}


echo '<script src="' . $PUBLIC_JS . '/updateRoles.js"></script>';
