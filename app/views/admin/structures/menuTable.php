<?php
include_once "collapseManageMenu.php";
include_once "modals.php";

function crearTablaMenu($listaMenu, $roles)
{
    $itemsEncontrados = 0;
    echo '
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col"></th>    
        <th scope="col">ID</th>    
        <th scope="col">Nombre</th>
        <th scope="col">Rol</th>
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
            if (is_null($fechaDeshabilitado)) {
                $itemsEncontrados++;
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
                $modalId = 'modalDelete_' . $item['idHijo'];
                modalDeleteMenu($modalId, $menu['id'], $item['idHijo'], $item['nombreHijo'], $subItems);
            }
        }
    }
    echo '</tbody>
    </table>';
    return $itemsEncontrados;
}

function crearTablaMenuInactivos($listaMenu)
{
    $itemsEncontrados = 0;
    echo '
        <table class="table table-striped table-bordered">
        <thead>
        <tr class="text-center card-title">   
            <th scope="col">ID</th>    
            <th scope="col">Nombre</th>
            <th scope="col">Rol</th>
            <th scope="col">Descripcion</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody class="table-group-divider card-text">
        ';
    foreach ($listaMenu as $menu) {
        $hijos = $menu['hijos'];
        $idMenuPadre = $menu['id'];
        foreach ($hijos as $item) {
            $nombreRol = $menu['nombre'];
            $subItems = $item['subHijos'];
            $fechaDeshabilitado = $item['fechaDeshabilitado'];
            if (!is_null($fechaDeshabilitado)) {
                if (!empty($subItems)) {
                    $descripcion = $item['descripcionHijo'];
                }
                $itemsEncontrados++;
                mostrarDatosTabla($item['idHijo'], $item['nombreHijo'], $nombreRol, $descripcion);
                $modalId = 'modalActivarMenu_' . $item['idHijo'];
                modalActivarMenu($modalId, $idMenuPadre, $item['nombreHijo']);
            }
            if (!empty($subItems)) {
                foreach ($subItems as $subitem) {
                    $fechaDeshabilitado = $subitem['fechaDeshabilitado'];
                    if (!is_null($fechaDeshabilitado)) {
                        $itemsEncontrados++;
                        $nombreRol = $menu['nombre'];
                        $descripcion = "Item perteneciente al selector " . $item['nombreHijo'];
                        mostrarDatosTabla($subitem['id'], $subitem['nombre'], $nombreRol, $descripcion);
                        $modalId = 'modalActivarMenu_' . $subitem['id'];
                        modalActivarMenu($modalId, $idMenuPadre, $subitem['nombre']);
                    }
                }
            }
        }
    }
    echo '</tbody>
        </table>';
    return $itemsEncontrados;
}

function mostrarDatosTabla($id, $nombre, $nombreRol, $descripcion = "sin descripcion")
{
    echo "<tr>";
    echo "<td class='card-title'>" . $id . "</td>";
    echo "<td>" . $nombre . "</td>";
    echo "<td>" . $nombreRol . "</td>";
    echo "<td>" . $descripcion . "</td>";
    echo "<td class='text-center'>
            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalActivarMenu_" . $id . "'>
                Activar
            </button>
        </td>";
    echo "</tr>";
}
