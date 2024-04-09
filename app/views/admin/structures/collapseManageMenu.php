<?php
function mostrarCollapse($id, $subMenu)
{
    echo '
    <tr class="collapse" id="collapseMenu' . $id . '">
        <td colspan="4">
            <table class="table" >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                ';
    foreach ($subMenu as $item) {
        $idSubHijo = $item['id'];
        $nombreSubHijo = $item['nombre'];
        $fechaDeshabilitado = $item['fechaDeshabilitado'];
        if (is_null($fechaDeshabilitado)) {
            //crear tabla
            echo "<tr>";
            echo "<td class='card-title'>" . $idSubHijo . "</td>";
            echo "<td>" . $nombreSubHijo . "</td>";
            echo "</tr>";
        }
    }
    echo '</tbody>
            </table>    
        </td>
    </tr>';
}
