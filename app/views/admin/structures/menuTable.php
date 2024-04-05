<?php
include_once "collapseManageMenu.php";
include_once "modals.php";

function crearTablaMenu($listaMenu, $roles)
{
    //viewStructure($listaMenu[0]);
    echo '
    <h4 class="mb-4 title text-center">Administrar Menus</h4>
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col"></th>    
        <th scope="col">ID</th>    
        <th scope="col">Nombre</th>
        <th scope="col">Rol</th>
        <th scope="col">Activo</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text">
    ';
    foreach ($listaMenu as $menu) {
        $hijos = $menu['hijos'];
        foreach ($hijos as $item) {
            $esSelector = false;
            $nombreRol = $menu['nombre'];
            $subItems = $item['subHijos'];
            $fechaDeshabilitado = $item['fechaDeshabilitado'];
            if (!empty($subItems)) {
                $esSelector = true;
                $nombreRol = $menu['nombre'] . " (" . $item['descripcionHijo'] . " )";
            }
            echo "<tr>";
            echo "<td>
                    " . ($esSelector
                ? "<a class='btn btn-link' data-bs-toggle='collapse' href='#collapseMenu" . $item['idHijo'] . "' role='button' aria-expanded='false' aria-controls='collapseMenu" . $item['idHijo'] . "'>
                        <img id='toggleIcon_" . $item['idHijo'] . "' src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/chevron-compact-right.svg' alt='right'>
                    </a>"
                : '') . "
                  </td>";
            echo "<td class='card-title'>" . $item['idHijo'] . "</td>";
            echo "<td>" . $item['nombreHijo'] . "</td>";
            echo "<td>" . $nombreRol . "</td>";
            echo "<td class='text-center'>" . ($fechaDeshabilitado ? 'NO' : 'SI') . "</td>";
            echo "<td class='text-center'>
            <a href='#' class='btn btn-outline-primary edit-btn' data-bs-toggle='modal' data-bs-target='#modalEdit_" . $item['idHijo'] . "' type='button' data-bs-tooltip='tooltip' data-bs-placement='left' data-bs-title='Editar'>
                <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/pen.svg' alt='edit'>
            </a>
            <a href='#' class='btn btn-outline-danger delete-btn' data-bs-toggle='modal' data-bs-target='#modalDelete_" . $item['idHijo'] . "' type='button' data-bs-tooltip='tooltip' data-bs-placement='right' data-bs-title='Desactivar'>
                <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/x-lg.svg' alt='trash'>
            </a>
          </td>";
            echo "</tr>";

            // Función que muestra el área de colapso
            mostrarCollapse($item['idHijo'], $subItems);
            $modalId = 'modalEdit_' . $item['idHijo'];
            modalEditMenu($modalId, $menu['id'],  $item['idHijo'], $item['nombreHijo'], $subItems, $roles);
            // $modalId = 'modalDelete_' . $persona->getIdUsuario();
            // modalDelete($modalId, $persona->getIdUsuario(), $persona->getUsNombre());
        }
    }
    echo '</tbody>
    </table>';
}
