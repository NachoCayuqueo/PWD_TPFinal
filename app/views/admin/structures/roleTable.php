<?php
include_once "roleModals.php";


function crearTablaRoles($listaRoles)
{
    echo '
    <h4 class="mb-4 title text-center">Listado de Roles</h4>
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text">
    ';
    foreach ($listaRoles as $rol) {
        echo "<tr>";
        echo "<td class='card-title'>" . $rol->getIdRol() . "</td>";
        echo "<td>" . $rol->getRoDescripcion() . "</td>";
        echo "<td class='text-center'>
                <a href='#' class='btn btn-outline-primary edit-btn' data-bs-toggle='modal' data-bs-target='#modalEdit_" . $rol->getIdRol() . "' type='button' data-bs-tooltip='tooltip' data-bs-placement='left' data-bs-title='Editar'>
                    <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/pen.svg' alt='edit'>
                </a>
                <a href='#' class='btn btn-outline-danger delete-btn' data-bs-toggle='modal' data-bs-target='#modalDelete_" . $rol->getIdRol() . "' type='button' data-bs-tooltip='tooltip' data-bs-placement='right' data-bs-title='Borrar'>
                    <img src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/trash3.svg' alt='trash'>
                </a>
              </td>";
        echo "</tr>";

        $modalId = 'modalEdit_' . $rol->getIdRol();
        modalEdit($modalId, $rol->getIdRol(), $rol->getRoDescripcion());

        $modalId = 'modalDelete_' . $rol->getIdRol();
        modalDelete($modalId, $rol->getIdRol(), $rol->getRoDescripcion());
    }
    echo '</tbody>
    </table>';
}
