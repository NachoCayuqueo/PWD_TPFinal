<?php

function crearTablaResumenCompra($listaCompras)
{
    echo '
    <h4 class="mb-4 title text-center">Resumen</h4>
    <table class="table table-striped table-bordered">
    <thead>
    <tr class="text-center card-title">
        <th scope="col"></th>
        <th scope="col">ID Compra</th>
        <th scope="col">Cantidad de Productos</th>
        <th scope="col">Fecha de Compra</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody class="table-group-divider card-text">
    ';
    foreach ($listaCompras as $compra) {
        $idCompra = $compra['idCompra'];
        $fechaCompra = $compra['fechaCompra'];
        $cantidadCompra = $compra['cantidadItems'];
        $precioTotal = $compra['precioTotal'];
        //crear tabla
        echo "<tr>";
        echo "<td><a class='btn btn-link' data-bs-toggle='collapse' href='#collapseCompras" . $idCompra . "' role='button' aria-expanded='false' aria-controls='collapseCompras" . $idCompra . "'>
                    <img id='toggleIcon_" . $idCompra . "' src='" . $GLOBALS['BOOTSTRAP_ICONS'] . "/chevron-compact-right.svg' alt='right'></a>
             </td>";
        echo "<td class='card-title'>" . $idCompra . "</td>";
        echo "<td>" . $cantidadCompra . "</td>";
        echo "<td>" . $fechaCompra . "</td>";
        echo "<td>" . $precioTotal . "</td>";
        echo "</tr>";

        // Función que muestra el área de colapso
        $listaProductos = $compra['compraItem'];
        collapseProducto($idCompra, $listaProductos);
    }
    echo '</tbody>
    </table>';
}

function collapseProducto($idCompra, $listaProductos)
{
    echo '
        <tr class="collapse" id="collapseCompras' . $idCompra . '">
            <td colspan="4">
                <table class="table" >
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
    foreach ($listaProductos as $producto) {
        $idProducto = $producto['idProducto'];
        $nombreProducto = $producto['nombreProducto'];
        $cantidadProducto = $producto['cantidadProducto'];
        $precioUnitario = $producto['precioUnitarioProducto'];
        //crear tabla
        echo "<tr>";
        echo "<td class='card-title'>" . $idProducto . "</td>";
        echo "<td>" . $nombreProducto . "</td>";
        echo "<td>" . $cantidadProducto . "</td>";
        echo "<td>" . $precioUnitario . "</td>";
        echo "</tr>";
    }
    echo '</tbody>
                </table>    
            </td>
        </tr>';
}

echo '<script src="' . $PUBLIC_JS . '/customer/changeCollapseButton.js"></script>';
